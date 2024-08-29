@extends('layout')

@section('konten')
<div class="container">
<h3>Fitur IPK Mahasiswa, Orangtua dari {{ $siswa->nama }}.</h3>
    
    <!-- Row 1: Data Mahasiswa dan Prestasi Akademik -->
    <div class="row mb-4">
        <!-- Data Mahasiswa Section -->
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card sm p-3 border-0">
                <h5 class="border-bottom pb-2">Data Mahasiswa:</h5>
                <table class="custom-table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $siswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td>{{ $siswa->NIM }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>{{ $siswa->prodi->nama_prodi }}</td>
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
        </div>

        <!-- Prestasi Akademik Section -->
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
    </div>

    <!-- Row 2: IPK Per Semester and Chart -->
    <div class="row">
        <!-- IPK Per Semester -->
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card sm p-3 border-0">
                <h5 class="border-bottom pb-2">IP Per Semester:</h5>
                <table class="custom-table">
                    <tbody>
                        @foreach ($ipkPerSemester as $semester => $nilai)
                        <tr>
                            <td>Semester {{ $semester }}</td>
                            <td>{{ $nilai }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart -->
        <div class="col-md-8">
            <div class="card shadow-sm p-1 bg-white rounded h-100" id="chartContainer">
                <h5 class="card-title text-center">Grafik IP Semester</h5>
                <div class="chart-container">
                    <canvas id="ipkChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #chartContainer {
        height: auto; /* Tinggi dinamis sesuai konten */
        max-height: 100%; /* Tinggi maksimal sama dengan kontainer */
        width: 100%; /* Lebar penuh */
    }

    .chart-container {
        height: 100%; /* Tinggi penuh dari kontainer */
    }

    #ipkChart {
        height: 100%; /* Menggunakan seluruh tinggi dari kontainer */
        width: 100%; /* Menggunakan seluruh lebar dari kontainer */
    }
</style>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('ipkChart').getContext('2d');

    // Convert the PHP array to a JavaScript array
    const ipkData = @json(array_values($ipkPerSemester));
    const labels = ipkData.map((_, index) => ` ${index + 1}`);

    const ipkChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'IPK',
                data: ipkData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    min: 0,
                    max: 4.0,
                    stepSize: 0.5,
                    title: {
                        display: true,
                        text: 'IP', // Label untuk sumbu Y
                        color: '#111',
                        font: {
                            family: 'Helvetica',
                            size: 16,
                            weight: 'bold',
                            lineHeight: 1.2,
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Semester', // Label untuk sumbu X
                        color: '#111',
                        font: {
                            family: 'Helvetica',
                            size: 16,
                            weight: 'bold',
                            lineHeight: 1.2,
                        }
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>

@endsection
