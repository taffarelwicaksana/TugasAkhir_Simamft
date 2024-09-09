<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @php
            $routeName = Route::currentRouteName();
            $title = 'SIMAM FT UNDIP'; // Default title

            switch ($routeName) {
                case 'dashboard.admin':
                    $title = 'Dashboard Admin - SIMAM FT UNDIP';
                    break;
                case 'dashboard.user':
                    $title = 'Dashboard Orangtua - SIMAM FT UNDIP';
                    break;
                case 'siswa.ipk':
                    $title = 'IPK Mahasiswa - SIMAM FT UNDIP';
                    break;
                case 'siswa.angkatan':
                    $title = 'IPK Angkatan - SIMAM FT UNDIP';
                    break;
                case 'siswa.prodi':
                    $title = 'IPK Prodi - SIMAM FT UNDIP';
                    break;
                case 'admin.siswa':
                    $title = 'Daftar Siswa - SIMAM FT UNDIP';
                    break;
                default:
                    $title = 'SIMAM FT UNDIP'; // fallback title
                    break;
            }
        @endphp
        {{ $title }}
    </title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
    <link href="{{ asset('/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/css_custom/css_custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Sidebar -->
    @include('assets.sidebar')

    <!-- Navbar -->
    @include('assets.navbar')

    <div class="container mt-3">
        @yield('konten')
    </div>

    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>

</html>
