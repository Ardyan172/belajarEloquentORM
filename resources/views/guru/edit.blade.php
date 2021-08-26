@extends('layout.app')

@section('title', 'Guru')

@section('judulContent', 'Silahkan Edit Data Guru')

@section('konten')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">Silahkan Edit Data Guru</h3>
	</div>

	<form action="{{ route('guru.update', $data->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
		@csrf
		@method('PUT')
		<div class="card-body">
			<div class="form-group row">
				<label for="namaGuru" class="col-sm-2 col-form-label">Nama Guru</label>
				<div class="col-sm-10">
					<input type="text" name="namaGuru" class="@error('namaGuru') is-invalid @enderror form-control" value="{{ $data->namaGuru }}" id="namaGuru" placeholder="Silahkan edit Nama Guru" autocomplete="off">
					<!-- validasi -> the error directive -->
					@error('namaGuru')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
				<div class="col-sm-10">
					<input type="text" name="mapel" class="@error('mapel') is-invalid @enderror form-control" 
					value="{{ $data->mapel }}" id="mapel" placeholder="Silahkan Edit Mata Pelajaran" autocomplete="off">
					@error('mapel')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="umur" class="col-sm-2 col-form-label">Umur Guru</label>
				<div class="col-sm-10">
					<input type="number" name="umur" class="@error('umur') is-invalid @enderror form-control" 
					value="{{ $data->umur }}" id="umur" placeholder="Silahkan Edit Umur Guru">
					@error('umur')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="fotoGuru" class="col-sm-2 col-form-label">Foto Guru</label>
				<div class="col-sm-10">
					<img src="{{ asset('fotoGuru') }}/{{ $data->fotoGuru }}" width="140px" alt="Foto Guru">
					<input type="file" name="fotoGuru" class="@error('fotoGuru') is-invalid @enderror form-control" id="fotoGuru">
					@error('fotoGuru')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
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