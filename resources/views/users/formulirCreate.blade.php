@extends('layout.app')

@section('title', 'Create Users')

@section('judulContent', 'Create Users')

@section('konten')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Silahkan Isi Semua Data Users Di Formulir</h3>
	</div>
	<!-- /.card-header -->
	<!-- form start -->
	<form method="POST" action="{{ route('users.store') }}">
		@csrf
		<div class="card-body">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control" id="name" placeholder="Masukan Nama Kamu" autocomplete="off">
				<!-- validasi error -->
				@error('name')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Masukan Email Kamu" autocomplete="off">
				<!-- validasi error -->
				@error('email')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="@error('password') is-invalid @enderror form-control" id="password" placeholder="Masukan Password Kamu" autocomplete="off">
				<!-- validasi error -->
				@error('password')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<!-- /.card-body -->

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="{{ route('users.index') }}" class="btn btn-danger">Back</a>
		</div>
	</form>
</div>
<!-- /.card -->
@endsection