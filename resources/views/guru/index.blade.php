@extends('layout.app')

@section('title', 'Guru')

@section('judulContent', 'Halaman Guru')

@section('tombolTambah')
<a href="{{ route('guru.create') }}" class="btn btn-primary">Tambah Guru</a>
@endsection

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Daftar Guru SMA 99</h3>
	</div>

	<div class="card-body">
      @if (session('status'))
         <div class="alert alert-success">{{ session('status') }}</div>
      @endif

		<table class="table table-bordered table-hover">
             <thead class="table-primary">
             	<tr>
                  <th class="nomor">Nomor</th>
                  <th class="namaGuru">Nama Guru</th>
                  <th class="mapel">Mata Pelajaran</th>
                  <th class="umur">Umur</th>
                  <th class="fotoGuru">Foto Guru</th>
                  <th class="aksiTransaksi">Aksi</th>
             	</tr>
         	</thead>

         	<tbody>
         		<?php $i = 1; ?>
         		@foreach($data as $guru)
         		<tr>
         			<td>{{ $i++ }}</td>
         			<td>{{ $guru->namaGuru }}</td>
         			<td>{{ $guru->mapel }}</td>
                  <td>{{ $guru->umur }}</td>
                  <td>
                     <img src="{{ asset('fotoGuru') }}/{{ $guru->fotoGuru }}" width="120px" alt="Foto Guru">
                  </td>
                  <!-- cetak propertynya -->
                  <td>
                     <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
                        @csrf
                        <a href="{{ route('guru.show', $guru->id) }}" class="btn btn-success btn-sm">Detail</a>
                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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

<!-- menampilkan paginasi -->
{{ $data->links() }}
@endsection