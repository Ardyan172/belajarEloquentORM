@extends('layout.app')

@section('title', 'Guru')

@section('judulContent', 'Silahkan Masukkan Data Guru')

@section('konten')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">Silahkan Masukkan Data Guru</h3>
	</div>

	<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
		@csrf
		<div class="card-body">
			<!-- Nama Guru -->
			<div class="form-group row">
				<label for="namaGuru" class="col-sm-2 col-form-label">Nama Guru</label>
				<div class="col-sm-10">
					<input type="text" name="namaGuru" class="form-control" id="namaGuru" placeholder="Silahkan Masukkan Nama Guru">
				</div>
			</div>

			<!-- mapel -->
			<div class="form-group row">
				<label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
				<div class="col-sm-10">
					<input type="text" name="mapel" class="form-control" id="mapel" placeholder="Silahkan Masukkan Mata Pelajaran">
				</div>
			</div>

			<!-- umur -->
			<div class="form-group row">
				<label for="umur" class="col-sm-2 col-form-label">Umur Guru</label>
				<div class="col-sm-10">
					<input type="number" name="umur" class="form-control" id="umur" placeholder="Silahkan Masukkan Umur Guru">
				</div>
			</div>

			<!-- foto guru -->
			<div class="form-group row">
				<label for="fotoGuru" class="col-sm-2 col-form-label">Foto Guru</label>
				<div class="col-sm-10">
					<input type="file" name="fotoGuru" class="form-control" id="fotoGuru">
				</div>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-info">Enter</button>
			<a href="{{ route('guru.index') }}" class="btn btn-danger float-right">Back</a>
		</div>
	</form>
</div>
@endsection