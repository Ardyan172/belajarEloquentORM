<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// models
use App\Models\Guru;
// menggunakan paginator bootstrap
use Illuminate\Pagination\Paginator;

class GuruController extends Controller
{
    public function __construct()
    {
        Paginator::useBootstrap();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guru.index', ['data' => Guru::simplePaginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.createGuru');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'namaGuru' => ['required', 'min:3', 'max:20'],
            'mapel' => ['required', 'min:2', 'max:20'],
            'umur' => ['required', 'max:2'],
            'fotoGuru' => ['required', 'mimes:jpg,png,jpeg', 'max:5000']
        ], [
            // namaGuru
            'namaGuru.required' => 'Nama guru tidak boleh kosong',
            'namaGuru.min' => 'Minimal 3 huruf',
            'namaGuru.max' => 'Maksimal 20 huruf',
            // mapel
            'mapel.required' => 'Mata pelajaran tidak boleh kosong',
            'mapel.min' => 'Masukkan minimal 2 huruf',
            'mapel.max' => 'Maksimal 20 huruf',
            // umur
            'umur.required' => 'Umur tidak boleh kosong',
            'umur.max' => 'Anda memasukkan umur yang salah',
            // fotoGuru
            'fotoGuru.required' => 'Masukkan foto guru',
            'fotoGuru.mimes' => 'Hanya boleh memasukkan foto dengan ekstensi jpg, png dan jpeg',
            'fotoGuru.max' => 'Ukuran foto maksimal adalah 5 MB',
        ]);

        // mengubah nama foto berdasarkan method time() PHP Dasar
        $namaFotoBaru = time() . '.' . $request->file('fotoGuru')->extension();
        // pindahkan foto ke folder public/fotoGuru
        $request->file('fotoGuru')->move(public_path('fotoGuru'), $namaFotoBaru);
        
        // sql syntax
        $guru = new Guru;
        $guru->namaGuru = $request->namaGuru;
        $guru->mapel = $request->mapel;
        $guru->umur = $request->umur;
        $guru->fotoGuru = $namaFotoBaru;
        $guru->save();
        
        // tanggapan -> mengarahkan dgn data sessi yang di flash
        return redirect()->route('guru.index')->with('status', 'Data guru ' . $request->namaGuru . ' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // sql syntax
        $dataSatuBaris = Guru::find($id);
        return view('guru.detailGuru', ['data' => $dataSatuBaris]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // cari data satu baris di table Guru berdasarkan id
        $menampilkanData = Guru::find($id);
        return view('guru.edit', ['data' => $menampilkanData]);
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
        $validasi = $request->validate([
            'namaGuru' => ['required', 'min:3', 'max:20'],
            'mapel' => ['required', 'min:2', 'max:20'],
            'umur' => ['required', 'max:2'],
            'fotoGuru' => ['required', 'mimes:jpg,jpeg,png', 'max:5000']
        ], [
            // namaGuru
            'namaGuru.required' => 'Nama guru tidak boleh kosong',
            'namaGuru.min' => 'Minimal 3 huruf',
            'namaGuru.max' => 'Maksimal 20 huruf',
            // mapel
            'mapel.required' => 'Mata pelajaran tidak boleh kosong',
            'mapel.min' => 'Minimal 2 huruf',
            'mapel.max' => 'Maksimal 20 huruf',
            // umur
            'umur.required' => 'Umur tidak boleh kosong',
            'umur.max' => 'Maksimal berumur 99 tahun',
            // foto guru
            'fotoGuru.required'=> 'Masukkan foto guru',
            'fotoGuru.mimes' => 'Hanya boleh memasukkan foto dengan ekstensi jpg, jpeg, png',
            'fotoGuru.max' => 'Ukuran foto maksimal adalah 5 MB'
        ]);

        // mengubah nama foto berdasarkan waktu user mengupload foto
        $namaFotoBaru = time() . $request->file('fotoGuru')->extension();
        // pindahkan foto
        $request->file('fotoGuru')->move(public_path('fotoGuru'), $namaFotoBaru);

        // sql sintax
        $dataSatuBaris = Guru::find($id);

        $dataSatuBaris->namaGuru = $request->namaGuru;
        $dataSatuBaris->mapel = $request->mapel;
        $dataSatuBaris->umur = $request->umur;
        $dataSatuBaris->fotoGuru = $namaFotoBaru;

        $dataSatuBaris->save();

        return redirect()->route('guru.index')->with('status', 'Data Guru ' . $request->namaGuru . ' berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus foto di public/fotoGuru
    }
}
