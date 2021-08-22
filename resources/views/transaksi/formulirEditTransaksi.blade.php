@extends('layout.app')

@section('title', 'Edit Transaksi')

@section('judulContent', 'Edit Transaksi')

@section('konten')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Silahkan Edit Data Transaksi Di Formulir</h3>
	</div>
	<!-- /.card-header -->
	<!-- form start -->
	<form method="POST" action="{{ route('transaksi.update', $data->id) }}" enctype="multipart/form-data">
		@csrf
		@method('PATCH')
		<div class="card-body">
			<div class="form-group">
				<label for="namaTransaksi">Nama Transaksi</label>
				<input type="text" name="namaTransaksi" value="{{ $data->namaTransaksi }} {{ old('namaTransaksi') }}" class="@error('namaTransaksi') is-invalid @enderror form-control" id="namaTransaksi" placeholder="Edit Nama Transaksi" autocomplete="off">
				<!-- validasi error -->
				@error('namaTransaksi')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="totalBiaya">Total Biaya</label>
				<input type="number" name="totalBiaya" value="{{ $data->totalBiaya }}" class="@error('totalBiaya') is-invalid @enderror form-control" id="totalBiaya" placeholder="Edit Total Biaya" autocomplete="off">
				<!-- validasi error -->
				@error('totalBiaya')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="fotoTransaksi">Foto Transaksi</label>
				<br>
				<img src="{{ asset('fotoTransaksi') }}/{{ $data->fotoTransaksi }}" width="120px" alt="Foto Transaksi">
				<input type="file" name="fotoTransaksi" class="@error('fotoTransaksi') is-invalid @enderror form-control" id="fotoTransaksi" placeholder="Edit Foto Transaksi Kamu">
				<!-- validasi error -->
				@error('fotoTransaksi')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<!-- /.card-body -->

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="{{ route('transaksi.index') }}" class="btn btn-danger">Back</a>
		</div>
	</form>
</div>
<!-- /.card -->
@endsection