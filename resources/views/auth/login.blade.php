<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMAM FT UNDIP</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <style>
        body {
            background: hsla(240, 100%, 22%, 1);
            background: linear-gradient(125deg, hsla(240, 100%, 22%, 1) 14%, hsla(197, 64%, 86%, 1) 100%);
            background: -moz-linear-gradient(125deg, hsla(240, 100%, 22%, 1) 14%, hsla(197, 64%, 86%, 1) 100%);
            background: -webkit-linear-gradient(125deg, hsla(240, 100%, 22%, 1) 14%, hsla(197, 64%, 86%, 1) 100%);
            filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#000072", endColorstr="#C3E5F2", GradientType=1 );
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px; /* Set a max width for the card */
            width: 100%;
        }
        .login-card .form-side {
            padding: 40px;
            flex: 1;
        }
        .login-card .image-side {
            flex: 1;
            background: url('{{ asset('login.png') }}') no-repeat center center;
            background-size: cover;
        }
        .login-card h4 {
            margin-bottom: 30px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #0062cc;
            border-color: #0062cc;
        }
        .btn-primary:hover {
            background-color: #004aad;
            border-color: #004aad;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="login-card mx-3">
        <div class="form-side">
            <h4>Selamat Datang di SIMAM FT UNDIP</h4>
            <p>Sistem Informasi Monitoring Akademik Fakultas Teknik Universitas Diponegoro</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="nim_nip" class="form-label">NIM Mahasiswa/NIP Admin</label>
                    <input type="text" class="form-control" name="nim_nip" id="nim_nip" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
        <div class="image-side">
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
