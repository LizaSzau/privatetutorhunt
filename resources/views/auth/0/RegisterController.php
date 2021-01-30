<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\VerifyUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Str;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
		
        $verifyUser = VerifyUser::create([
            'id_user' => $user->id,
            'token' => base64_encode(Hash::make(Str::random(40)))
        ]);
		
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
			
            if($user->flag == null) 
			{
                $verifyUser->user->flag = 1;
                $verifyUser->user->date_active = now();
                $verifyUser->user->save();
                $status = trans('auth.verifiedSuccess');
            }
			else
			{
				$status = trans('auth.verifiedSuccessAlready');
            }
        }
		else
		{
            return redirect('/'.str_slug(trans('auth.register'), '-'))->with('warning', trans('auth.verifiedFail'));
        }
 
        return redirect('/'.str_slug(trans('auth.login'), '-'))->with('status', $status);
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
