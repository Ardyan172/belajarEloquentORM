@extends('layout.app')

@section('title', 'Detail Transaksi')

@section('judulContent', 'Halaman Detail Transaksi')

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Detail Transaksi {{ $data->namaTransaksi }}</h3>
	</div>

	<div class="card-body">
		<h5>{{ $data->totalBiaya }}</h5>
      <h5>{{ $data->created_at }}</h5>
      <h5>{{ $data->updated_at }}</h5>
      <img src="{{ asset('fotoTransaksi') }}/{{ $data->fotoTransaksi }}" width="160px" alt="Foto Transaksi">
	</div>

   <div class="card-footer">
      <a href="{{ route('transaksi.index') }}" class="btn btn-danger">Back</a>
   </div>
</div>
@endsection