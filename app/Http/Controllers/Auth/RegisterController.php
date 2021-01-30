<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Tutor;
use App\Models\TutorReady;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\VerifyUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Str;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

//******************************************************************************
// Register user with e-mail
//******************************************************************************

    protected function register(Request $request)
    {
		$user_social = DB::table('users')->where('email', $request->email)->first();
	
		// Logged in with social media before
		if ($user_social && $user_social->password == '') {
			
			$validator = Validator::make($request->all(), [
				'name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255',
				'password' => 'required|string|max:255|min:8',
			]);

			if ($validator->fails()) {
				return redirect('register')
							->withErrors($validator)
							->withInput();
			}
			
			$user = User::find($user_social->id);
			$user->name = $request->name;
			$user->password = Hash::make($request->password);
			$user->save();
			
		} else {
		// not logged in with social media before	
			$validator = Validator::make($request->all(), [
				'name' => 'required|string|max:255',
				'email' => 'required|unique:users|string|email|max:255',
				'password' => 'required|string|max:255|min:8',
			]);

			if ($validator->fails()) {
				return redirect('register')
							->withErrors($validator)
							->withInput();
			}
			
			DB::beginTransaction();

			try {
				// create user
				$user = User::create([
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make($request->password),
				]);
				
				// create a new tutor
				$tutor = Tutor::create([
					'user_id' => $user->id
				]);
				
				// create tutor_ready
				TutorReady::create([
					'tutor_id' => $tutor->id	
				]);
				
				// create verify_user
				$verifyUser = VerifyUser::create([
					'id_user' => $user->id,
					'token' => base64_encode(Hash::make(Str::random(40)))
				]);
				
				DB::commit();
			} catch (\Exception $e) {
				DB::rollback();
				return redirect('login')->with('status', $e);	
			}
		} 
		
		Mail::to($user->email)->send(new VerifyMail($user));
		
		return redirect('successfully-registered')->with('status', trans('auth.verifiedSent'));	
    }
	
//******************************************************************************
// Verify user by e-mail token
//******************************************************************************

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
		
        if(isset($verifyUser) )
		{
            $user = $verifyUser->user;
	
            if($user->verified_at == null) 
			{
                $verifyUser->user->verified_at = now();
                $verifyUser->user->save();
                $status = trans('auth.verifiedSuccess');
            }
			else
			{
				return redirect('/login')->with('email_already_verified', 'already verified');
            }
        }
		else
		{
            return redirect('/login')->with('email_not_verified', 'not verified');
        }
 
        return redirect('/login')->with('email_verified', 'verified');
    }
	
//******************************************************************************
// Logout user after register and ask for verifying e-mail
// (Nem kell, mert felül van írva a register fubnction)
//******************************************************************************

	protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('successfully-registered')->with('status', trans('auth.verifiedSent'));
    }
}
