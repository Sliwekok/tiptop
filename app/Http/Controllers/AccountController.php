<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Exceptions\PasswordTokenNotFound;
use App\Http\Services\AnimalService;
use App\Http\Services\ChangeHistory;
use App\Http\Services\MessageService;
use App\Http\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{

    private $messageService;
    private $userService;
    private $animalService;
    private $changeHistory;

    public function __construct(UserService $userService, MessageService $messageService, AnimalService $animalService, ChangeHistory $changeHistory)
    {
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->animalService = $animalService;
        $this->changeHistory = $changeHistory;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        try {

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                throw new Exception('Wystąpił błąd podczas logowania. Spróbuj ponownie.', 401);
            }

            toast()->success('Zalogowano do aplikacji.');

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to($request->get('ref'));

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        toast()->success('Pomyślnie wylogowano z aplikacji.');
        return redirect()->to('/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function createAccount(Request $request)
    {
        try {
            $this->userService->createUser($request->get('name'), $request->get('email'), $request->get('password'), $request->get('messagesNotification'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function facebookRegister(Request $request)
    {
        try {
            $this->userService->facebookRegister(
                $request->get('name'),
                $request->get('email'),
                $request->get('messagesNotification'),
                $request->get('provider'),
                $request->get('secure'),
                $request->get('id')
            );
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function changeUserName(Request $request)
    {
        try {
            $this->userService->changeUserName($request->get('name'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/konto/ustawienia');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function changeUserEmail(Request $request)
    {
        try {
            $this->userService->changeUserEmail($request->get('email'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/konto/ustawienia');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function removeAccount(Request $request)
    {
        try {
            $this->userService->removeAccount($request->get('password'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/konto/ustawienia');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function changePassword(Request $request)
    {
        try {

            $this->userService->changePassword($request->get('oldPassword'), $request->get('password'));

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/konto/ustawienia');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function saveNotificationsSettings(Request $request)
    {
        try {

            $this->userService->saveNotificationsSettings($request->get('notifications'));

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/konto/ustawienia');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function resetPassword(Request $request)
    {
        try {
            $this->userService->resetPassword($request->get('email'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/');

    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPasswordView($token)
    {

        try {

            if (!$token) {
                throw new PasswordTokenNotFound();
            }

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return view('set-password')->with([
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setNewPassword(Request $request)
    {

        try {

            if ($request->get('password') != $request->get('repeatPassword')) {
                toast()->error('Wpisane hasła różnią się od siebie. Hasło nie zostało zmienione.');
                return redirect()->back();
            }

            $this->userService->setNewPassword($request->get('passwordToken'), $request->get('password'));

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('/');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error()
    {

        $exception = session('exception');

        if (!$exception) {
            return redirect()->to('/');
        }

        Log::error($exception);

        return view('error', ['exception' => $exception]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userAddedAnimals()
    {
        $idUser = Auth::user()->id;
        $animals = Animal::where('id_user', '=', $idUser)->with(['photo'])->orderBy('created_at', 'desc')->get();

        return view('user.animals-list', ['animals' => $animals]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function userAccountSettings()
    {

        $historyChanges = $this->changeHistory->getChangesByName(Auth::user()->id);

        return view('user.settings', ['historyChanges' => $historyChanges]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userAccountThreads()
    {
        $threads = Auth::user()->threads()->get();
        return view('user.threads', ['threads' => $threads]);
    }

    /**
     * @param $threadId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getThreadMessages($threadId)
    {
        $data = $this->messageService->getMessages($threadId);
        return view('user.messages', ['messages' => $data['messages'], 'title' => $data['title'], 'threadId' => $threadId, 'recipientDeleted' => $data['recipientDeleted']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replyMessage(Request $request)
    {

        try {
            $this->messageService->sendMessage(null, $request->get('message'), null, $request->get('threadId'));
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('konto/wiadomosci/' . $request->get('threadId'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createMessage(Request $request)
    {

        try {
            $animal = $this->animalService->getAnimal($request->get('idAnimal'));
            $title = animalSpecies($animal->species) . ', ' . $animal->name;
            $this->messageService->sendMessage($animal->id_user, $request->get('message'), $title);
            toast()->success('Wiadomość została wysłana.');
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('ogloszenie/szczegoly/' . $animal->id);

    }

}
