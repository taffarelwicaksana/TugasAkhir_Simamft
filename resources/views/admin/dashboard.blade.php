@extends('layout')

@section('konten')
<div>
    <h3>Dashboard Admin</h3>

    <!-- Statistik Umum -->
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Mahasiswa</h4>
                    <h3>{{ $jumlahMahasiswa }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Program Studi</h4>
                    <h3>{{ $jumlahProdi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h4 class="card-title">Rata-rata IPK</h4>
                    <h3>{{ number_format($rataRataIPK, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Mahasiswa per Angkatan -->
    <div class="card mt-4">
        <div class="card-body custom-card">
            <h4 class="card-title ">Mahasiswa per Angkatan</h4>
            <table class="table">
                <thead class="table-secondary">
                    <tr>
                        <th >Angkatan</th>
                        <th>Jumlah Mahasiswa</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach($jumlahMahasiswaPerAngkatan as $data)
                    <tr>
                        <td>{{ $data->angkatan }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Akses Cepat -->
    <div class="row justify-content-center my-4">
        <div class="d-grid gap-2">
            <a href="{{route('admin.siswa')}}" class="btn btn-block custom-btn">Daftar Mahasiswa</a>
        </div>
    </div>

    <!-- Grafik Pertumbuhan IPK -->
    <div id="ipkGrowthChart" style="height: 400px;"></div>
</div>

<!-- ECharts Library -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>

<!-- Grafik Pertumbuhan IPK -->
<script>
    var ipkGrowthChartDom = document.getElementById('ipkGrowthChart');
    var ipkGrowthChart = echarts.init(ipkGrowthChartDom);
    var ipkGrowthOption;

    ipkGrowthOption = {
        title: {
            text: 'Perbandingan IPK Angkatan',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis'
        },
        xAxis: {
            type: 'category',
            data: @json($xAxisData)
        },
        yAxis: {
            type: 'value',
            min: 0,
            max: 4.0
        },
        series: [
            {
                name: 'IPK',
                type: 'bar',
                data: @json($seriesData),
                smooth: false,
                lineStyle: {
                    width: 4,
                    color: '#5470C6'
                },
                itemStyle: {
                    color: '#37B7C3'
                },
                areaStyle: {
                    color: 'rgba(55, 183, 195, 1)'
                }
            }
        ]
    };

    ipkGrowthOption && ipkGrowthChart.setOption(ipkGrowthOption);
</script>

<style>
    .custom-btn {
        background-color: #37B7C3;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 16px;

        transition: background-color 0.3s;
    }

    .custom-btn:hover {
        background-color: #2fd2e1;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
    }
    .custom-card {
        background-color: #f8f9fa; /* Light background for cards */
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2); /* Subtle shadow for depth */
        transition: box-shadow 0.3s;
    }

</style>
@endsection
