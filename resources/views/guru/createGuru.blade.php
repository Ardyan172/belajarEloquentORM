@extends('layout.app')

@section('title', 'Guru')

@section('judulContent', 'Silahkan Masukkan Data Guru')

@section('konten')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">Silahkan Masukkan Data Guru</h3>
	</div>

	<form action="" method="POST" class="form-horizontal">
		<div class="card-body">
			<div class="form-group row">
				<label for="namaGuru" class="col-sm-2 col-form-label">Nama Guru</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="namaGuru" placeholder="Silahkan Masukkan Nama Guru">
				</div>
			</div>
		</div>
	</form>
</div>
@endsection