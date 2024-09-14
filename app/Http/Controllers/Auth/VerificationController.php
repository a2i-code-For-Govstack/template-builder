<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('verify', 'resend');
    }

    public function show()
    {
        return view('auth.verify');
    }
    
    
    public function verify(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            Auth::login($user);
        }
        
        //return redirect($this->redirectPath())->with('verified', true);
        return redirect("/home")->with('verified', true);
    }
    
    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        
        $user = User::where('email', $request->email)->first();

        if ($user&& is_null($user->email_verified_at)) {
            // Send verification email
            $user->sendEmailVerificationNotification();
            return back()->with('status', 'Verification email has been resent!');
        }

        return back()->withErrors(['email' => 'Email not found or already verified.']);
    }
}
