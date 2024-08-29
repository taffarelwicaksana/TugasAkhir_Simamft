@extends('layout')

@section('konten')

<div class="container mt-4">
    <h3>Data Siswa</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                
                <th>Angkatan</th>
                <th>Semester Berjalan</th>
                <th>Dosen Wali</th>
                <th>NIP Dosen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $student)
                <tr>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->nim }}</td>
                    
                    <td>{{ $student->angkatan }}</td>
                    <td>{{ $student->semester_berjalan }}</td>
                    <td>{{ $student->dosbing->nama_dosbing }}</td>
                    <td>{{ $student->dosbing->NIP }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="#" class="btn btn-primary">IPK Mahasiswa</a>
        <a href="#" class="btn btn-secondary">IPK Program Studi</a>
        <a href="#" class="btn btn-success">IPK Angkatan</a>
    </div>
</div>

@endsection
