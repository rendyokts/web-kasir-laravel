<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterUserModel;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/mobile/loginApi",
     *     tags={"Auth"},
     *     summary="Login user",
     *     description="Login menggunakan email/username dan password",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"login","password"},
     *             @OA\Property(property="login", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", example="rahasia123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Login berhasil"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="2|abcdef..."),
     *                 @OA\Property(property="token_type", type="string", example="Bearer"),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                     @OA\Property(property="username", type="string", example="johndoe"),
     *                     @OA\Property(property="telp", type="string", example="08123456789"),
     *                     @OA\Property(property="role", type="string", example="admin"),
     *                     @OA\Property(property="status", type="string", example="Aktif")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Login gagal / akun tidak aktif"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi input gagal"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Terjadi kesalahan server"
     *     )
     * )
     */

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
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'username' => $user->username ?? null,
                            'telp' => $user->telp ?? null,
                            'role' => $user->role,
                            'status' => $user->status == 1 ? 'Aktif' : 'Tidak Aktif'
                        ]
                    ]
                ], 200);
            } else {
                $userExists = MasterUserModel::where($login_type, $request->login)->first();
                if ($userExists && Hash::check($request->password, $userExists->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Akun anda sudah tidak aktif. Silahkan hubungi admin',
                        'errors' => [
                            'login' => ['Akun anda sudah tidak aktif. Silahkan hubungi admin']
                        ]
                    ], 401);
                } else {
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
