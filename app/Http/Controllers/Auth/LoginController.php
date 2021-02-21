<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Tutor;
use App\Models\TutorReady;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
		 $this->middleware('guest', ['except' => ['logout']]);
    }

    protected $providers = [
       'facebook','google','twitter'
    ];

//******************************************************************************
// Show login form
//******************************************************************************
    public function showLoginForm() {
        return view('auth.login');
    }	

//******************************************************************************
// Overriding authentication routes - to check if user is verified
//******************************************************************************
	
    public function authenticated(Request $request, $user)
    {	
        if ($user->flag == 0 ) 
		{
            auth()->logout();
			Session()->flush();
			return redirect()->route('login')->with('restricted_user', 'restricted user');
		}

        if ($user->provider == null && $user->verified_at == null) 
		{ 
            auth()->logout();
			Session()->flush();
			return redirect()->route('login')->with('not_verified', 'not verified');
		}
		
        return redirect()->intended('/tutor/dashboard');
    }
	
//******************************************************************************
// Login with e-mail
//******************************************************************************
    public function login(Request $request)
    {
        //$credentials = $request->only('email', 'password', 'remember');
		$email = $request->email;
		$password = $request->password;
		$remember = $request->remember;
			
		if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Authentication passed...
            //return redirect()->intended('dashboard');
			return $this->authenticated($request, auth()->user());
        } else {
			return redirect()->route('login')
				->withErrors(['msg' => 'The e-mail address and password combination entered do not match any account. Please try again.']);
		}
    }
	
//******************************************************************************
// Redirect to provider
//******************************************************************************
    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported.");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            //return $this->sendFailedResponse($e->getMessage());
			$message = trans('auth.socialite-driver', [ 'driver' => ucfirst($driver) ]);
			return $this->sendFailedResponse($message);
        }
    }

//******************************************************************************
// Handle provider callback
//******************************************************************************

    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

//******************************************************************************
// Send success respond
//******************************************************************************

    protected function sendSuccessResponse()
    {
        return redirect()->intended('/tutor/dashboard');
    }

//******************************************************************************
// Send failed respond
//******************************************************************************

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

//******************************************************************************
// Login or create account
//******************************************************************************

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
			DB::transaction(function() use ($providerUser, $driver) {
				// create a new user
				$user = User::create([
					'name' => $providerUser->getName(),
					'email' => $providerUser->getEmail(),
					'avatar' => $providerUser->getAvatar(),
					'provider' => $driver,
					'provider_id' => $providerUser->getId(),
					'access_token' => $providerUser->token,
					// user can use reset password to create a password
					'password' => ''
				]);
				
				// create a new tutor
				$tutor = Tutor::create([
					'user_id' => $user->id	
				]);
				
				// create tutor_ready
				TutorReady::create([
					'tutor_id' => $tutor->id	
				]);
			});
        }

        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

//******************************************************************************
// Is provider allowed
//******************************************************************************

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
	
//******************************************************************************
// Logout
//******************************************************************************

    public function logout()
    {
		auth()->logout();
		Session()->flush();
		return redirect()->route('guest_home');
    }
}