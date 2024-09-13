<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Auth;


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

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $this->validateLogin($request);
         
        if ($this->attemptLogin($request)) {
            
            
            $user = $this->guard()->user();
            //$user = User::where('email', $request->email)->first();
            $token = $user->createToken("API-TOKEN")->plainTextToken;
            $user->api_token = $token;
            if ($user->hasVerifiedEmail()) {
                return $this->sendLoginResponse($request);
                
            } 
            else {
                $this->guard()->logout();
                return redirect('/login')->with('warning', 'You need to verify your email address before you can log in. Check your inbox');
            }
            
        }
        
        return $this->sendFailedLoginResponse($request);
        
        
    }
    
    public function loginRequest(Request $request)
    {   
        $this->validateLogin($request);
         
        if ($this->attemptLogin($request)) {
            
            
            $user = $this->guard()->user();
            //$user = User::where('email', $request->email)->first();
            $token = $user->createToken("API-TOKEN")->plainTextToken;
            $user->api_token = $token;
            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' =>$token
                ], 200);
            } 
            else {
                $this->guard()->logout();
                return redirect('/login')->with('warning', 'You need to verify your email address before you can log in. Check your inbox');
            }
            
        }
        
        return $this->sendFailedLoginResponse($request);
        
        
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {   
        
        return Auth::attempt($request->only(['email', 'password']));
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        
        
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/login");
    }

    public function username()
    {
        return 'email';
    }

}
