@extends('layout.app')

@section('title', 'Guru')

@section('judulContent', 'Silahkan Masukkan Data Guru')

@section('konten')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">Silahkan Masukkan Data Guru</h3>
	</div>

	<form action="{{ route('guru.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
		@csrf
		<div class="card-body">
			<div class="form-group row">
				<label for="namaGuru" class="col-sm-2 col-form-label">Nama Guru</label>
				<div class="col-sm-10">
					<input type="text" name="namaGuru" class="@error('namaGuru') is-invalid @enderror form-control" value="{{ old('namaGuru') }}" id="namaGuru" placeholder="Silahkan Masukkan Nama Guru">
					<!-- validasi -> the error directive -->
				</div>

				@error('namaGuru')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group row">
				<label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
				<div class="col-sm-10">
					<input type="text" name="mapel" class="@error('mapel') is-invalid @enderror form-control" 
					value="{{ old('mapel') }}" id="mapel" placeholder="Silahkan Masukkan Mata Pelajaran">
				</div>
				@error('mapel')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group row">
				<label for="umur" class="col-sm-2 col-form-label">Umur Guru</label>
				<div class="col-sm-10">
					<input type="number" name="umur" class="@error('umur') is-invalid @enderror form-control" 
					value="{{ old('umur') }}" id="umur" placeholder="Silahkan Masukkan Umur Guru">
				</div>
				@error('umur')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group row">
				<label for="fotoGuru" class="col-sm-2 col-form-label">Foto Guru</label>
				<div class="col-sm-10">
					<input type="file" name="fotoGuru" class="@error('fotoGuru') is-invalid @enderror form-control" id="fotoGuru">
				</div>
				@error('fotoGuru')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-info">Enter</button>
			<a href="{{ route('guru.index') }}" class="btn btn-danger float-right">Back</a>
		</div>
	</form>
</div>
@endsection