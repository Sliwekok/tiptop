<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\FacebookLoginErrorException;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Debugbar;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        session(['facebookRedirect' => request()->input('ref')]);
        return Socialite::driver('facebook')->fields(['first_name', 'email'])->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback()
    {

        try {

            $this->redirectTo = session('facebookRedirect');
            $user = Socialite::driver('facebook')->user();

            $authUser = $this->findOrCreateUser($user, 'facebook');

            if ($authUser == null) {
                $secure = md5($user->id . $user->email . 'facebook');
                return view('facebook-register', ['user' => $user, 'provider' => 'facebook', 'secure' => $secure]);
            }

            Auth::login($authUser, true);

            toast()->success('Zalogowano do aplikacji.');

            return redirect($this->redirectTo);

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

    }

    public function facebookRegister($user, $provider)
    {
        return view('facebook-register', ['user' => $user, 'provider' => $provider]);
    }

    /**
     * @param $user
     * @param $provider
     * @return mixed
     * @throws Exception
     */
    public function findOrCreateUser($user, $provider)
    {

        try {

            if ($user->email == null) {
                throw new FacebookLoginErrorException();
            }

            $authUser = User::where('email', '=', $user->email)->orWhere('provider_id', $user->id)->where('provider', '=', $provider)->first();

            if ($authUser) {
                if ($authUser->provider_id == null) {
                    $authUser->update([
                        'provider_id' => $user->getId(),
                        'provider' => $provider
                    ]);
                }
                return $authUser;
            }

            return null;

        } catch (Exception $ex) {
            throw $ex;
        }

    }
}
