<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthenticationController extends Controller
{
    //
    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = (boolean) ($request->remember ?? false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            else if (Auth::user()->isEmployee()) {
                return redirect()->route('employee.dashboard');
            }
            else {
                return redirect()->route('customer.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class),
            ],
            'password' => 'required|confirmed',
            'date_of_birth' => 'required|before:today',
        ]);

        try {

            $user = User::query()->create($data);

            Auth::login($user);

            $request->session()->regenerate();

        } catch (\Throwable $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return back()->with('success', false);
        }

        return view('customer.dashboard');

    }

    public function handleLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function handleForgotPassword(Request $request) {
        $data = $request->validate([
           'email' => [
               'required',
               'email',
               Rule::exists(User::class)
           ]
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        $token = Str::random(64);

        DB::table('password_reset_tokens')
            ->insert([
                'email' => $user->email,
                'token' => $token
            ]);

        Mail::send('mail-forgot', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Forgot Password');
        });

        return back()->with('success', 'Send mail forgot password success, Please check your email');
    }

    public function showFormReset($token) {
        $email = DB::table('password_reset_tokens')->where('token', $token)->value('email');
        return view('auth.reset-password', compact('email', 'token'));
    }

    public function handleResetPassword(Request $request) {

        $data = $request->validate([
            'email' => ['required', 'email', Rule::exists(User::class)],
            'password' => 'required|confirmed'
        ]);

        $passwordReset = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Invalid token!']);
        }

        $user = User::query()->where('email', $request->email)->first();
        $user->password = $data['password'];
        $user->save();

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('login')->with('success', 'Your password has been changed!');
    }

}
