<?php

namespace App\Http\Services;


use App\Animal;
use App\Exceptions\EmailAlreadyExists;
use App\Exceptions\PasswordTokenNotFound;
use App\Exceptions\WrongFacebookRegisterData;
use App\Mail\AccountCreated;
use App\Mail\AccountDeleted;
use App\Mail\PasswordReset;
use App\Messages;
use App\MessageThreadUsers;
use App\Photos;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Debugbar;

class UserService
{

    private $changeHistory;

    public function __construct(ChangeHistory $changeHistory)
    {
        $this->changeHistory = $changeHistory;
    }

    /**
     * @param $name string
     * @param $email string
     * @param $password string
     * @param $notifications string
     * @param null $provider
     * @param null $providerId
     * @return int
     * @throws Exception
     */
    public function createUser($name, $email, $password, $notifications, $provider = null, $providerId = null): int
    {

        try {

            if (User::where('email', '=', $email)->exists()) {
                throw new EmailAlreadyExists();
            }

            if ($notifications) {
                $notifications = true;
            } else {
                $notifications = false;
            }

            $id = User::insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'provider' => $provider,
                'provider_id' => $providerId,
                'notifications' => $notifications,
                'is_disabled' => false,
                'is_active' => true,
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $this->changeHistory->create('TERMS', env('TERMS_UPDATE_DATE', ''), $id);
            $this->changeHistory->create('PRIVACY_POLICY', env('TERMS_UPDATE_DATE', ''), $id);
            $this->changeHistory->create('PERSONAL_DATA', env('PERSONAL_DATA_DATE', ''), $id);

            if ($notifications) {
                $this->changeHistory->create('MESSAGES_NOTIFICATION', 'Tak', $id);
            } else {
                $this->changeHistory->create('MESSAGES_NOTIFICATION', 'Nie', $id);
            }

//            Mail::to($email)->queue(new AccountCreated($name));

            toast()->success('Twoje konto zostało utworzone. Możesz się teraz zalogować.');

        } catch (Exception $ex) {
            throw $ex;
        }

        return $id;

    }

    /**
     * @param $name
     * @param $email
     * @param $messagesNotification
     * @param $provider
     * @param $secure
     * @param $providerId
     * @return bool
     * @throws Exception
     */
    public function facebookRegister($name, $email, $messagesNotification, $provider, $secure, $providerId): bool
    {

        try {

            if (md5($providerId . $email . $provider) !== $secure) {
                throw new WrongFacebookRegisterData();
            }

            $password = md5(rand(1000, 9999) . rand(1000, 9999) . time());

            $id = $this->createUser($name, $email, $password, $messagesNotification, $provider, $providerId);

            $authUser = User::where('id', '=', $id)->first();

            Auth::login($authUser, true);

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $name string
     * @return bool
     * @throws Exception
     */
    public function changeUserName($name): bool
    {

        try {

            $idUser = Auth::user()->id;
            $oldUserName = Auth::user()->name;

            if ($name == $oldUserName) {
                toast()->error("Nowa nazwa użytkownika musi się różnić od aktualnej.");
                return false;
            }

            User::where('id', '=', $idUser)->update([
                'name' => $name
            ]);

            $this->changeHistory->create('CHANGE_USER_NAME', json_encode([
                'oldName' => $oldUserName,
                'newName' => $name
            ]), $idUser);

            toast()->success("Zmiana nazwy użytkownika została zapisana.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $email string
     * @return bool
     * @throws Exception
     */
    public function changeUserEmail($email): bool
    {

        try {

            $idUser = Auth::user()->id;
            $oldEmail = Auth::user()->email;

            if ($email == $oldEmail) {
                toast()->error("Nowy adres email musi być inny niż aktualny.");
                return false;
            }

            if (User::where('email', '=', $email)->where('id', '!=', $idUser)->exists()) {
                toast()->error("W bazie danych istnieje już użytkownik o takim adresie email.");
                return false;
            }

            User::where('id', '=', Auth::user()->id)->update([
                'email' => $email
            ]);

            $this->changeHistory->create('CHANGE_USER_EMAIL', json_encode([
                'oldEmail' => $oldEmail,
                'newEmail' => $email
            ]), $idUser);

            toast()->success("Zmiana adresu email została zapisana.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $oldPassword string
     * @param $newPassword string
     * @return bool
     * @throws Exception
     */
    public function changePassword($oldPassword, $newPassword): bool
    {

        try {

            $idUser = Auth::user()->id;

            $user = User::where('id', '=', $idUser)->first();

            if (!password_verify($oldPassword, $user->password)) {
                toast()->error("Wpisano błędne aktualne hasło.");
                return false;
            }

            if (password_verify($newPassword, $user->password)) {
                toast()->error("Nowe hasło musi się różnić od aktualnego.");
                return false;
            }

            $user->update([
                'password' => Hash::make($newPassword)
            ]);

            $this->changeHistory->create('CHANGE_PASSWORD', '', $idUser);

            toast()->success("Hasło zostało zmienione.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $notifications
     * @return bool
     * @throws Exception
     */
    public function saveNotificationsSettings($notifications): bool
    {

        try {

            if ($notifications) {
                $notifications = true;
            } else {
                $notifications = false;
            }

            $idUser = Auth::user()->id;

            User::where('id', '=', $idUser)->update(['notifications' => $notifications]);

            if ($notifications) {
                $this->changeHistory->create('MESSAGES_NOTIFICATION', 'Tak', $idUser);
            } else {
                $this->changeHistory->create('MESSAGES_NOTIFICATION', 'Nie', $idUser);
            }

            toast()->success("Ustawienia dotyczące powiadomień zostały zmienione.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $email string
     * @return bool
     * @throws Exception
     */
    public function resetPassword($email): bool
    {

        try {

            $user = User::where('email', '=', $email)->first();

            if (!$user) {
                toast()->error("Brak użytkownika o podanym adresie e-email.");
                return false;
            }

            $token = md5($user->id . $user->email . time() . rand(10, 999));

            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::to($user->email)->queue(new PasswordReset($token));

            toast()->success("Na podany adres e-mail został wysłany link umożliwiający ustawienie nowego hasła do konta.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $token string
     * @param $password string
     * @return bool
     * @throws Exception
     */
    public function setNewPassword($token, $password): bool
    {

        try {

            $entry = DB::table('password_resets')->where('token', '=', $token)->first();

            if (!$entry) {
                throw new PasswordTokenNotFound();
            }

            User::where('email', '=', $entry->email)->update([
                'password' => Hash::make($password)
            ]);

            DB::table('password_resets')->where('token', '=', $token)->delete();

            toast()->success("Hasło do Twojego konta zostało zmienione, można się teraz zalogować używając nowego hasła.");

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $password string
     * @return bool
     * @throws Exception
     */
    public function removeAccount($password): bool
    {

        try {

            $user = User::where('id', '=', Auth::user()->id)->first();
            $userEmail = $user->email;
            $photos = [];

            if (!password_verify($password, $user->password)) {
                toast()->error("Wpisano błędne hasło. Konto NIE zostało usunięte.");
                return false;
            }

            $faker = \Faker\Factory::create();

            DB::transaction(function () use ($user, $faker, &$photos) {

                $userName = $faker->userName;

                $user->update([
                    'name' => $userName,
                    'password' => Hash::make($faker->password),
                    'email' => $userName . '@sarz.pl',
                    'notifications' => false,
                    'deleted_at' => Carbon::now()
                ]);

                Messages::where('sender_id', '=', $user->id)->update(['body' => 'Wiadomość usunięta przez użytkownika.']);
                MessageThreadUsers::where('user_id', '=', $user->id)->update(['deleted_at' => Carbon::now()]);

                $animalsIds = Animal::where('id_user', '=', $user->id)->get()->pluck('id');
                $photos = Photos::whereIn('id_animal', $animalsIds)->get()->pluck('file_name');

                Photos::whereIn('id_animal', $animalsIds)->delete();
                Animal::where('id_user', '=', $user->id)->delete();

            });

            foreach ($photos as $photo) {
                unlink(public_path('upload/animals/' . $photo));
            }

            Mail::to($userEmail)->queue(new AccountDeleted());
            Auth::logout();

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

}