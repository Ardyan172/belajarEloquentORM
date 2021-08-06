@extends('layout.app')

@section('title', 'Transaksi')

@section('judulContent', 'Halaman Transaksi')

@section('tombolTambah')
<a href="" class="btn btn-success">Tambah Transaksi</a>
@endsection

@section('konten')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Daftar Transaksi Yang Sudah Dilakukan</h3>
	</div>

	<div class="card-body">
		<table class="table table-bordered table-hover">
             <thead class="table-primary">
             	<tr>
                  <th class="nomor">Nomor</th>
                  <th class="namaTransaksi">Nama Transaksi</th>
                  <th class="totalBiaya">Total Biaya</th>
                  <th class="fotoTransaksi">Foto Transaksi</th>
                  <th class="aksiTransaksi">Aksi</th>
             	</tr>
         	</thead>

         	<tbody>
         		<?php $i = 1; ?>
         		@foreach($semuaTransaksi as $transaksi)
         		<tr>
         			<td>{{ $i++ }}</td>
         			<td>{{ $transaksi->namaTransaksi }}</td>
         			<td>{{ $transaksi->totalBiaya }}</td>
                  <td>
                     <img src="{{ asset('fotoTransaksi') }}/{{ $transaksi->fotoTransaksi }}" width="80px" alt="Foto Transaksi">
                  </td>
                  <!-- cetak propertynya -->
                  <td>
                     <a href="" class="btn btn-primary btn-sm">Detail</a>
                     <a href="" class="btn btn-warning btn-sm">Edit</a>
                     <a href="" class="btn btn-danger btn-sm">Hapus</a>
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
{{ $semuaTransaksi->links() }}
@endsection