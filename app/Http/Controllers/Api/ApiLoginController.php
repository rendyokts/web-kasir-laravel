<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterUserModel;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function loginApi(Request $request)
    {
        $validator = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Username/Email kamu kosong nihh',
            'password.required' => 'Upss.... passwordnya masih kosong nihh',
        ]);

        try {
            $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $user = MasterUserModel::where($login_type, $request->login)
                ->where('status', 1)
                ->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'data' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'username' => $user->username ?? null,
                        'telp' => $user->telp ?? null,
                        'role' => $user->role,
                        'status' => $user->status == 1 ? 'Aktif' : 'Tidak Aktif'
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ], 200);
            } else {
                // Cek apakah user ada tapi tidak aktif
                $userExists = MasterUserModel::where($login_type, $request->login)->first();

                if ($userExists && Hash::check($request->password, $userExists->password)) {
                    // User ada tapi tidak aktif
                    return response()->json([
                        'success' => false,
                        'message' => 'Akun anda sudah tidak aktif. Silahkan hubungi admin',
                        'errors' => [
                            'login' => ['Akun anda sudah tidak aktif. Silahkan hubungi admin']
                        ]
                    ], 401);
                } else {
                    // Kredensial salah
                    return response()->json([
                        'success' => false,
                        'message' => 'Login gagal, cek lagi email/username dan passwordnya',
                        'errors' => [
                            'login' => ['Login gagal, cek lagi email/username dan passwordnya']
                        ]
                    ], 401);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
