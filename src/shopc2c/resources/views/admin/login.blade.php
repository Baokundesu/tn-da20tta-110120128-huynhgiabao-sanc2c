<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .form-signin .checkbox {
            font-weight: 400;
            text-align: left;
        }
        .form-signin .form-group label {
            text-align: left;
        }
        .form-signin .btn-primary {
            background-color: #1977cc;
            border-color: #1977cc;
        }
        .form-signin .btn-primary:hover {
            background-color: #135995;
            border-color: #135995;
        }
    </style>
</head>
<body class="text-center">
    <form class="form-signin" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <img class="mb-4" src="{{ asset('images/logo.jpg') }}" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Admin Đăng nhập</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-group text-left">
            <label for="inputUsername">Tên đăng nhập</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>
        <div class="form-group text-left">
            <label for="inputPassword">Mật khẩu</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
    </form>
</body>
</html>
