@extends('layout.app')

@section('title', 'Edit Users')

@section('judulContent', 'Edit Users')

@section('konten')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Silahkan Edit Data Users Di Formulir</h3>
	</div>
	<!-- /.card-header -->
	<!-- form start -->
	<form action="{{ route('users.update', $detailUser->id) }}" method="POST">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" value="{{ $detailUser->name }} {{ old('name') }}" class="@error('name') is-invalid @enderror form-control" id="name" placeholder="Edit Nama Kamu" autocomplete="off">
				<!-- validasi error -->
				@error('name')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="{{ $detailUser->email }} {{ old('email') }}" class="@error('email') is-invalid @enderror form-control" id="email" placeholder="Edit Email Kamu" autocomplete="off">
				<!-- validasi error -->
				@error('email')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="@error('password') is-invalid @enderror form-control" id="password" placeholder="Edit Password Kamu">
				<!-- validasi error -->
				@error('password')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<!-- /.card-body -->

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
		</div>
	</form>
</div>
<!-- /.card -->
@endsection