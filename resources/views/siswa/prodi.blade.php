@extends('layout')

@section('konten')
<div>
    <h3>Fitur IPK Program Studi, Orangtua dari {{ $siswa->nama }}.</h3>

    <div class="row">
        <!-- Student Information Section -->
        <div class="col-md-6">
            <h4>Data Mahasiswa</h4>
            <table class="custom-table p-1">
                <tbody>
                    <tr>
                        <td class="col-fixed">Nama</td>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>{{ $siswa->NIM }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>{{ $siswa->prodi->nama_prodi }}</td> <!-- Pastikan ini mengacu pada nama program studi -->
                    </tr>
                    <tr>
                        <td>Angkatan</td>
                        <td>{{ $siswa->angkatan }}</td>
                    </tr>
                    <tr>
                        <td>Semester Berjalan</td>
                        <td>{{ $siswa->semester_berjalan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Academic Performance Section -->
        <div class="prestasi-akademik-container col-md-6">
            <div class="row">
                
                <div class="col">
                    <h5>IPK</h5>
                    <p>{{ number_format($ipk, 2) }}</p>
                </div>
                <div class="col">
                    <h5>SKS</h5>
                    <p>{{ $totalSKS }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontainer untuk perbandingan IPK dan rata-rata IPK program studi -->
    <div class="row mt-4">
        <!-- Rata-rata IPK Program Studi -->
        <div class="col-md-6">
            <div class="custom-card-left">
                <p>Program Studi: {{ $siswa->prodi->nama }}</p> <!-- Pastikan ini mengacu pada nama program studi -->
                <p>Rata-rata IPK Mahasiswa Program Studi: {{ number_format($averageIPKProdi, 2) }}</p>
            </div>
        </div>

        <!-- Perbandingan IPK dengan rata-rata -->
        <div class="col-md-6">
            <div class="custom-card-right d-flex align-items-center">
                <div>
                    <p>IPK Mahasiswa: <strong>{{ number_format($ipk, 2) }}</strong></p>
                    <p class="percentage">
                        @if ($persentaseIPK > 0)
                            <span class="increase">▲ {{ number_format(abs($persentaseIPK), 2) }}%</span> Higher than Average
                        @elseif ($persentaseIPK < 0)
                            <span class="decrease">▼ {{ number_format(abs($persentaseIPK), 2) }}%</span> Lower than Average
                        @else
                            Average
                        @endif
                    </p>
                </div>
                <div class="medal-icon">
                    🏅
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
