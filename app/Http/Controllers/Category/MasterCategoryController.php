<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Models\MasterCategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MasterCategoryController extends Controller
{
    public function index()
    {
        // Melakukan query
        $query = MasterCategoryModel::select('*')->get();
        // -> digunakan untuk debugging sebelum menampilkan datanya pada table,
        // dd($query);
        //debugging 
        return view('master_category.index', compact('query'));
        //view disini mengarah ke file (.) titik menandakan folder jadi dibaca folder master_user, file nya index
    }

    //function add kategori
    public function createCategory()
    {

        $data = new MasterCategoryModel;
        return view('master_category.add_category', compact('data'));
    }

    // function save
    public function saveCategory(Request $request) 
    {
        // dd($request->all());
        $mandatory = [
            'kode_kategori' => 'required | unique:kategori', // Required artinya diisi
            'nama' => 'required'
        ];

        $validator = Validator::make($request->all(), $mandatory, [
            'kode_kategori.required' => 'Kode wajib diisi',
            'kode_kategori.unique' => 'Kode Kategori tidak boleh sama',
            'nama.required' => 'Nama wajib diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back(); //jika gagal akan kembali lagi ke halaman pengisian user
        }

        $id = $request->input('id'); // digunakan untuk mengisikan Id yang ada di table database, secara otomatis

        // digunakan untuk melakukan pengecekan id nya apakah sudah ada di database, jika ada maka akan dilakukan edit, jika tidak ada berati ini adalah user baru
        if (!empty($id)) {
            $data = MasterCategoryModel::find($id);
        } else {
            $data = new MasterCategoryModel;
            // $data->created_by = auth()->user()->id;
        }


        // ini adalah inputan user, berkaitan dengan form di tampilan
        $data->kode_kategori = $request->input('kode_kategori');
        $data->nama = $request->input('nama');
        $data->save(); //disimpan ke database dengan nama table users yang ada di MasterUserModel --> models nya

        return redirect()->route('master_category.index')->with('toast_success', 'Kategori berhasil disimpan')->with('category_saved', $data);
    }

    public function editCategory($id) //passing ke routes parameter id nya
    {
        //dilakukan pencarian dulu by id
        $data = MasterCategoryModel::find($id);
        return view('master_category.add_category', compact('data'));
    }

    public function deleteCategory($id)
    {
        $data = MasterCategoryModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
