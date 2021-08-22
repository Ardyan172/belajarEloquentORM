@extends('layout.app')

@section('title', 'Detail Guru')

@section('judulContent', 'Halaman Detail Guru')

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Detail Guru {{ $data->namaGuru }}</h3>
	</div>

	<div class="card-body">
		<h5>Mata Pelajaran : {{ $data->mapel }}</h5>
		<h5>Umur : {{ $data->umur }}</h5>
		<h5>Data Dibuat Pada Tanggal : {{ $data->created_at }}</h5>
		<h5>Data Diperbarui Pada Tanggal : {{ $data->updated_at }}</h5>
		<img src="{{ asset('fotoGuru') }}/{{ $data->fotoGuru }}" width="140px" alt="Foto Guru">
	</div>

	<div class="card-footer">
		<a href="{{ route('guru.index') }}" class="btn btn-danger">Back</a>
	</div>
</div>
@endsection