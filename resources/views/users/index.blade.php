@extends('layout.app')

@section('title', 'Users')

@section('judulContent', 'Halaman Users')

@section('tambahUsers')
<div class="row">
   <div class="col-12">
      <a href="{{ route('users.create') }}" class="btn btn-success float-right">Tambah Users</a>
   </div>
</div>
@endsection

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Yo ndak tau kok tanya saya</h3>
	</div>

	<div class="card-body">
		<table id="example2" class="table table-bordered table-hover">
             <thead class="table-primary">
             	<tr>
                  <th>Nomor</th>
                  <th>Nama</th>
                  <th>Email</th>
             	</tr>
         	</thead>

         	<tbody>
         		<?php $i = 1; ?>
         		@foreach($semuaData as $user)
         		<tr>
         			<td>{{ $i++ }}</td>
         			<td>{{ $user->name }}</td>
         			<td>{{ $user->email }}</td>
                  <!-- cetak propertynya -->
         		</tr>
         		@endforeach
         	</tbody>

         	<tfoot>
                <tr>
                   <th>Penutup</th>
                </tr>
            </tfoot>
         </table>
	</div>
</div>
@endsection