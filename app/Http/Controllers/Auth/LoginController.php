<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class LoginController extends Auth
{

    //login session
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view ("auth/login");
    }

    public function loginProses( Request $request)
    {
        $request -> validate([
            'login' => 'required',
            'password' => 'required',
        ],[
            'login.required' => 'Username/Email kamu kosong nihh',
            'password.required' => 'Upss.... passwordnya masih kosong nihh',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($login_type, $request->login)->where('status',1)->first();

        if ($user && Hash::check($request->password,$user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } else {
            $userExists = User::where($login_type, $request->login)->first();

            if ($userExists && Hash::check($request->password,$userExists->password)) {
                return back()->withErrors([
                    'login'=> 'Akun anda sudah tidak aktif. Silahkan hubungi admin',
                ]);
            } else {
                return back()->withErrors([
                    'login' => 'login gagal, cek lagi email/username dan passwordnya',
                ]);
            }
        }

    //     $infoLogin =[
    //         $login_type => $request -> login,
    //         'password' => $request -> password,
    //     ];
    //      if (Auth::attempt($infoLogin)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended(route('dashboard'));
    //     } else {
    //         return back()->withErrors([
    //     'login' => 'Login gagal, cek lagi email/username dan password borr.',
    // ]);
    //     }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    //register session
    public function register()
    {
        return view("auth.register");
    }

    public function create(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'telp' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password',
        ],[
            'name.required' => 'Uppss..namanya masih kosong nihh',
            'telp.required' => 'Uppss..no.hp nya masih kosong nihh',
            'username.required' => 'Uppss..usernama masih kosong nihh',
            'username.unique' => 'Usernamenya udah pernah di pake borr..coba username lain',
            'email.required' => 'Emailnya manaa??',
            'email.email' => 'Emailnya yang bener dongg',
            'email.unique' => 'Emailnya pernah di pake borr..coba email lain',
            'password.required' => 'Passwordnya masih kosong nihh',
            'password.min' => 'Dikit banget pw nya kaya gaji situ',
            'password_confirmation' => 'Samain dong pw nya sama yang diatas',

        ]);

        $data = [
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'kasir',
            'status' => 2,
            'username' => $request->username,
        ];
        User::create($data);
        return redirect()->route('login')->with('success','Registrasi berhasil borr');
    }


    //reset password
    public function passwordRequest()
    {
        return view('auth.forgot-password');
    }

    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
        ? back()->with('success','Silahkan cek email anda untuk membuat password baru')
        : back()->withErrors(['email'=> __($status)]);
    }

    public function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password'
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function(User $user, string $password) {
                $user->forceFill([
                    'password'=> Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
        ? redirect()->route('login')->with('success','Password berhasil di ubah!!')
        : back()->withErrors(['email' => [__($status)]]);
    }
}

