<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// modelsnya
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', ['semuaData' => Users::all()]);
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
        // buat validasi
        $validasiData = $request->validate([
            'name' => ['required', 'unique:users', 'min:4', 'max:20'], 
            'email' => ['required', 'unique:users', 'max:20'],
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
            'email.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
            // password
            'password.required' => 'Kamu belum memasukkan password',
            'password.min' => 'Kamu harus memasukkan minimal 6 huruf',
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
        return "ok";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
