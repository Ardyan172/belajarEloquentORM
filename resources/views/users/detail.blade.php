@extends('layout.app')

@section('title', 'Detail Users')

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Detail {{ $detailUser->name }}</h3>
	</div>

	<div class="card-body">
	  <p>Name : {{ $detailUser->name }}</p>
     <p>Email : {{ $detailUser->email }}</p>
     <p>Password : {{ $detailUser->password }}</p>
     <!-- cetak semua propertynya -->

     <a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
	</div>
</div>
@endsection