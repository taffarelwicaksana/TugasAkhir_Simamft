<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAM FT UNDIP</title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
    <link href="{{ asset('/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/css_custom/css_custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Navbar -->
    @include('partials.navbar')

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
