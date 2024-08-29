@extends('layout')

@section('konten')

<div>
    <div class="d-flex">
        <h3>Selamat datang di SIMAM FT UNDIP, Orangtua dari {{ $siswa->nama }}.</h3>

    </div>
    <div>

    </div>
    <h6>Data diri:</h6>
    <table class="custom-table ">
        <tr>
            <th class="col-fixed">Nama</th>
            <th>{{ $siswa->nama }}</th>
            <th></th>
        </tr>

        <tr>
            <th>NIM</th>
            <th>{{ $siswa->NIM }}</th>
            <th></th>
        </tr>
        <tr>
            <th>Program Studi</th>
            <th>{{ $siswa->prodi->nama_prodi }}</th>
            <th></th>
        </tr>

        <tr>
            <th>Angkatan</th>
            <th>{{ $siswa->angkatan }}</th>
            <th></th>
        </tr>
        <tr>
            <th>Semester berjalan</th>
            <th>{{ $siswa->semester_berjalan }}</th>
            <th></th>
        </tr>
    </table>
    <br>
    <h6>Dosen Wali:</h6>
    <table class="custom-table ">
        <tr>
            <th class="col-fixed">nama</th>
            <th>{{ $siswa->dosbing->nama_dosbing }}</th>
            <th></th>
        </tr>

        <tr>
            <th>NIP</th>
            <th>{{ $siswa->dosbing->NIP }}</th>
            <th></th>
        </tr>
    </table>
    <br>
    <div class="button-container">
        <div class="left-buttons">
        @can('access-user')    
        <a class="btn-a" href="{{route('siswa.ipk')}}">IPK MAHASISWA</a>
        @endcan
        @can('access-user')    
        <a class="btn-b" href="{{route('siswa.prodi')}}">IPK PROGRAM STUDI</a>
        @endcan
        </div>
        <a class="btn-c" href="">IPK ANGKATAN</a>
    </div>


</div>

@endsection