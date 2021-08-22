<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// model
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
// paginasi
use Illuminate\Pagination\Paginator;

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
            'totalBiaya' => ['required', 'min:5'],
            'fotoTransaksi' => ['required', 'mimes:jpg,png,jpeg', 'max:5000'],
            // MIME
        ], [
            // namaTransaksi
            'namaTransaksi.required' => 'Kamu belum memasukkan nama transaksi',
            'namaTransaksi.min' => 'Kamu harus memasukkan minimal 2 huruf',
            'namaTransaksi.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20',
            // totalBiaya
            'totalBiaya.required' => 'Kamu harus memasukkan total biaya',
            'totalBiaya.min' => 'Minimal transaksi adalah 10000',
            'fotoTransaki.required' => 'Kamu harus memasukkan foto transaksi',
            'fotoTransaksi.mimes' => 'hanya boleh memasukkan foto dengan ekstensi jpg, png, jpeg',
            'fotoTransaksi.max' => 'Ukuran maksimal foto adalah 5 MB',
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
        return redirect()->route('transaksi.index')->with('status', 'Transaksi ' . $request->namaTransaksi . ' Berhasil Dibuat');
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
        // mendapatkan data satu baris menggunan Eloquent ORM
        $dataSatuBaris = Transaksi::find($id);
        return view('transaksi.formulirEditTransaksi', ['data' => $dataSatuBaris]);
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
        $validasiFormulir = $request->validate([
            'namaTransaksi' => ['required', 'min:2', 'max:20'],
            'totalBiaya' => ['required', 'min:5'],
            'fotoTransaksi' => ['required', 'file', 'mimes:jpg,png,jpeg', 'max:5000']
        ], [
            // namaTransaksi
            'namaTransaksi.required' => 'Kamu belum memasukkan nama transaksi',
            'namaTransaksi.min' => 'Kamu harus memasukkan minimal 2 huruf',
            'namaTransaksi.max' => 'Maksimal huruf yang bisa kamu masukkan adalah 20 huruf',
            // totalBiaya
            'totalBiaya.required' => 'Kamu belum memasukkan total biaya',
            'totalBiaya.min' => 'Minimal transaksi adalah 10000',
            'fotoTransaksi.required' => 'Kamu belum memasukkan foto transaksi',
            'fotoTransaksi.file' => 'Hanya boleh memasukkan file foto',
            'fotoTransaksi.mimes' => 'Hanya boleh memasukkan foto dengan ekstensi jpg, png atau jpeg',
            'fotoTransaksi.max' => 'Ukuran maksimal foto adalah 5 MB'
        ]);

        // sql syntax
        // ambil data satu baris berdasarkan id
        $dataSatuBaris = Transaksi::find($id);
        $dataSatuBaris->namaTransaksi = $request->namaTransaksi;
        $dataSatuBaris->totalBiaya = $request->totalBiaya;

        // ganti nama foto berdasarkan waktu user mengupload foto
        $namaFotoBaru = time() . '.' . $request->fotoTransaksi->extension();
        $dataSatuBaris->fotoTransaksi = $namaFotoBaru;
        // pindahkan gambar ke folder public/fotoTransaksi
        $request->fotoTransaksi->move(public_path('fotoTransaksi'), $namaFotoBaru);
        $dataSatuBaris->save();
        // mengarahkankan ke route sambil mengirimkan data yang di flash
        return redirect()->route('transaksi.index')->with('status', 'Data Transaksi ' . $request->namaTransaksi . ' telah diperbarui');
    }

    /**
     * menggunakan pembuat query laravel bukan Eloquent ORM
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $namaTransaksi = $transaksi->namaTransaksi;
        $foto = $transaksi->fotoTransaksi;
        DB::table('transaksi')->where('id', '=', $id)->delete();
        unlink(public_path('fotoTransaksi/' . $foto));
        return redirect()->route('transaksi.index')->with('status', 'Data ' . $namaTransaksi . ' Berhasil Dihapus');
    }
}
