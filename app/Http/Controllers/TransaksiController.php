<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// model
use App\Models\Transaksi;
// paginasi
use Illuminate\Pagination\Paginator;
// hash gambar
use Illuminate\Support\Facades\Hash;

class TransaksiController extends Controller
{
    // method ini otomatis di jalankan walaupun saya tidak membuat objectnya karena saya menggunakan LARAVEL 8
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

        return view('transaksi.index', ['semuaTransaksi' => Transaksi::simplePaginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.formulirCreateTransaksi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi error
        $validasiFormulir = $request->validate([
            'namaTransaksi' => ['required', 'min:2', 'max:20'],
            'totalBiaya' => ['required'],
            'fotoTransaksi' => ['required', 'mimes:jpg,png,jpeg', 'max:7000'],
            // MIME
        ], [
            // namaTransaksi
            'namaTransaksi.required' => 'Kamu belum memasukkan nama transaksi',
            'namaTransaksi.min' => 'Kamu harus memasukkan minimal 2 huruf',
            'namaTransaksi.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20',
            // totalBiaya
            'totalBiaya.required' => 'Kamu harus memasukkan total biaya',
            'fotoTransaki.required' => 'Kamu harus memasukkan foto transaksi',
            'fotoTransaksi.mimes' => 'hanya boleh memasukkan foto dengan ekstensi jpg, png, jpeg',
            'fotoTransaksi.max' => 'Ukuran gambar maksimal 7000',
        ]);


        $namaFoto = time() . '.' . $request->fotoTransaksi->extension();
        $request->fotoTransaksi->move(public_path('fotoTransaksi'), $namaFoto);

        // memasukkan data ke table
        $transaksi = new Transaksi;
        $transaksi->namaTransaksi = $request->namaTransaksi;
        $transaksi->totalBiaya = $request->totalBiaya;
        $transaksi->fotoTransaksi = $namaFoto;
        $transaksi->save();
        
        // return dan mengirimkan sessi flash
        return redirect()->route('transaksi.index')->with('status', 'Transaksi Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // cari data satu baris dari tabel Transaksi berdasarkan id yang dikirimkan
        $mengambilSatuBaris = Transaksi::find($id);
        return view('transaksi.detailTransaksi', ['data' => $mengambilSatuBaris]);
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
