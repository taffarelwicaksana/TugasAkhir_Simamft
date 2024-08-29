@extends('layout')

@section('konten')


<div class="margin">
    <h2>tambah siswa</h2>
    <form action="{{route('siswa.submit')}}" method="post">
        @csrf
        <label>Nama</label>
        <input type="text" name="nama" placeholder="masukkan nama anda" class="form-control mb-2">
        <label>NIM</label>
        <input type="number" name="nim" placeholder="masukkan nim anda" class="form-control mb-2">
        <label>Alamat</label>
        <input type="text" name="alamat" placeholder="masukkan Alamat anda" class="form-control mb-2">
        <button class='btn btn-primary'>input</button>
    </form>
</div>


@endsection