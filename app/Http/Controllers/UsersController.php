<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// modelsnya
use App\Models\Users;
// validasi
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// paginator
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        return view('users.index', ['semuaData' => Users::simplePaginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.formulirCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // lakukan validasi
        $validasiData = $request->validate([
            'name' => ['required', 'unique:users', 'min:4', 'max:20'], 
            'email' => ['required', 'unique:users', 'max:30'],
            'password' => ['required', 'min:7', 'max:20'],
            // index bail berfungsi menghentikan kegagalan validasi pertama
        ], [
            // nama
            'name.required' => 'Kamu belum memasukkan nama',
            'name.unique' => 'Nama ini sudah digunakan orang lain',
            'name.min' => 'Kamu harus memasukkan minimal 4 huruf',
            'name.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
            // email
            'email.required' => 'Kamu belum memasukkan email',
            'email.unique' => 'Email ini sudah digunakan orang lain',
            'email.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 30 huruf',
            // password
            'password.required' => 'Kamu belum memasukkan password',
            'password.min' => 'Kamu harus memasukkan minimal 7 huruf',
            'password.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
        ]);

        // query insert laravel untuk menyimpan data ke table users
        $users = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        // Mengarahkan dengan data sesi yang di flash
        return redirect()->route('users.index')->with('status', 'Users Baru Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailUser = Users::where('id', $id)->first();
        return view('users.detail', ['detailUser' => $detailUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ambil semua data berdasarkan id yang dikirimkan
        $detailUser = Users::where('id', $id)->first();
        return view('users.formulirEdit', ['detailUser' => $detailUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasiData = $request->validate([
            // name
            'name' => [
                'required', 'min:4', 'max:20',
                Rule::unique('users')->ignore($id),
            ],
            // email
            'email' => [
                'required', 'max:30',
                Rule::unique('users')->ignore($id)
            ],
            // password
            'password' => ['required', 'min:7', 'max:20'],
        ], [
            // nama
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama tadi sudah digunakan orang lain',
            'name.min' => 'Kamu harus memasukkan minimal 4 huruf',
            'name.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
            // email
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email tadi sudah digunakan orang lain',
            'email.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 30 huruf',
            // password
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Kamu harus memasukkan minimal 7 huruf',
            'password.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
        ]);


        // cari ID di table users lalu dapatkan semua datanya
        $users = Users::find($id);

        // lakukan query update 1#
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;

        // lakukan query update #2
        $users->save();
        
        // mengarahkan dengan data sesi yang di flash
        return redirect()->route('users.index')->with('status', 'Data Users Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusUsersBerdasarkanID = Users::where('id', $id)->delete();
        return redirect()->route('users.index')->with('status', 'Users Berhasil Dihapus');
    }
}
