<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MasterUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MasterUserController extends Controller
{
    // Index ini berguna untuk menampilkan semua data user di table
    public function index()
    {
        // Melakukan query
        $query = MasterUserModel::select('*')->get();
        // -> digunakan untuk debugging sebelum menampilkan datanya pada table,
        // dd($query);
        //debugging 
        return view('master_user.index', compact('query'));
        //view disini mengarah ke file (.) titik menandakan folder jadi dibaca folder master_user, file nya index
    }

    public function createUser()
    {
        $data = new MasterUserModel;
        return view('master_user.add_user', compact('data'));
    }

    // menyimpan user yang di daftarkan
    public function saveUser(Request $request)
    {
        // mandatori berarti harus diisi jika tidak mandatori atau nullable, tidak perlu declare disini
        $mandatory = [
            'name'       => 'required', // Required artinya diisi
            'username'   => 'required',
            'status'     => 'required',
            'role'       => 'required',
            'email'      => 'required',
            'telp'    => 'required'
        ];

        // dilakukan pengecekan daripada input di mandatory apakah sudah diisi atau belum oleh user
        $validator = Validator::make($request->all(), $mandatory, [
            'name.required'     => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'status.required'   => 'Status user wajib diisi',
            'email.required'    => 'Email wajib diisi',
            'telp.required'  => 'Nomor telpon wajib diisi'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back(); //jika gagal akan kembali lagi ke halaman pengisian user
        }

        $id = $request->input('id'); // digunakan untuk mengisikan Id yang ada di table database, secara otomatis

        // digunakan untuk melakukan pengecekan id nya apakah sudah ada di database, jika ada maka akan dilakukan edit, jika tidak ada berati ini adalah user baru
        if (!empty($id)) {
            $data = MasterUserModel::find($id);
        } else {
            $data = new MasterUserModel;
            // $data->created_by = auth()->user()->id;
        }


        // ini adalah inputan user, berkaitan dengan form di tampilan
        $data->name = $request->input('name');
        $data->username = $request->input('username');
        $data->telp = $request->input('telp');
        $data->email = $request->input('email');
        $data->role = $request->input('role');
        $data->status = $request->input('status');
        $data->save(); //disimpan ke database dengan nama table users yang ada di MasterUserModel --> models nya

        return redirect()->route('master_user.index')->with('toast_success', 'Data user berhasil disimpan')->with('user_saved', $data);
    }

    // function mengubah user
    public function editUser($id) //passing ke routes parameter id nya
    {
        //dilakukan pencarian dulu by id
        $data = MasterUserModel::find($id);
        return view('master_user.add_user', compact('data'));
    }

    public function deleteUser($id)
    {
        $data = MasterUserModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
