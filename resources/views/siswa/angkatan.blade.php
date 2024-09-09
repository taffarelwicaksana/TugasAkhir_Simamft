@extends('layout')

@section('konten')
<div>
    <h3>Fitur IPK Angkatan 
    </h3>

    <div class="row">
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
                            <td> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    <p>{{ number_format($totalSKS,0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Average IPK for the Batch Section -->
    <div>
        <div class="row">
            <!-- Existing Container Left -->
            <div class="col-md-6">
                <div class="custom-card-left">
                    <p>Program Studi: {{ $siswa->prodi->nama_prodi }}</p>
                    <p>Rata-rata IPK Mahasiswa Angkatan {{$siswa->tahun_ajar}} :{{ number_format($averageIPKAngkatan, 2) }}</p>
                </div>
            </div>

            <!-- Existing Container Right -->
            <div class="col-sm-4">
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
    <!-- Bar Chart Section -->
    <div>
        <h4>Perbandingan IPK Angkatan </h4>
        <div style="max-height: 500px; height: auto;">
            <canvas id="ipkChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ipkChart').getContext('2d');
    const dataIpkAngkatan = @json($dataIpkAngkatan); // Memastikan data dari Laravel di-parse menjadi JSON

    const ipkChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataIpkAngkatan.labels,
            datasets: [{
                label: 'IPK',
                data: dataIpkAngkatan.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4.0
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
