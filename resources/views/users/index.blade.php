@extends('layout.app')

@section('title', 'Users')

@section('judulContent', 'Halaman Users')

@section('tambahUsers')
<a href="{{ route('users.create') }}" class="btn btn-success">Tambah Users</a>
@endsection

@section('konten')
<div class="card">
   @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
   @endif

	<div class="card-header">
		<h3 class="card-title">Daftar Pengguna Yang Sudah Bergabung</h3>
	</div>

	<div class="card-body">
		<table style="width:100%" id="example2" class="table table-bordered table-hover">
             <thead class="table-primary">
             	<tr>
                  <th class="nomor">Nomor</th>
                  <th class="nama">Nama</th>
                  <th class="email">Email</th>
                  <th class="aksi">Aksi</th>
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
                  <td>
                     <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- hapus -->
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                     </form>
                  </td>
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

<!-- paginasi -->
{{ $semuaData->onEachSide(1)->links() }}

@endsection