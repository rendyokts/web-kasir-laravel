<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user(); //Gunakan stateless()->user() hanya untuk API atau situasi khusus dimana session tidak tersedia atau tidak diperlukan.

        $find_user = User::where('email', $user->email)->first();

        if($find_user) {

            if($find_user->status != 1) {
                return redirect()->route('login')->withErrors(['Akun Anda belum di aktifkan oleh admin. Silahkan hubungi admin']);
            }
            Auth::login($find_user);
        } else {
            $new_user = [
                'name'            => $user->name,
                'username'        => explode('@', $user->email)[0],
                'email'           => $user->email,
                'email_verified_at'=>now(),
                'telp'            => '',
                'google_id'       => $user->id,
                'password'        => Hash::make('my-google'),
                'status'          => 2,
                'regist_by_google'=> 2,
            ];
            User::create($new_user);
            // Auth::login($new_user);
            return redirect()->route('login')->with('info','Akun anda telah dibuat. Silahkan tunggu persetujuan admin');
        }
        return redirect()->intended(route('dashboard'));
    }
}
