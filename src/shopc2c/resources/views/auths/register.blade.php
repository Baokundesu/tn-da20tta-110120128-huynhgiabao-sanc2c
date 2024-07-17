<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-signin {
            width: 100%;
            max-width: 360px; /* Increased max-width */
            padding: 20px; /* Increased padding */
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 50px;
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
        .form-signin .form-check-label {
            line-height: 1.4; 
        }
    </style>
</head>
<body class="text-center">
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        @csrf
        <img class="mb-4" src="{{ asset('images/logo.jpg') }}" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Đăng ký</h1>
        <div class="form-group text-left">
            <label for="name">Họ tên</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Họ tên" required autofocus>
        </div>
        <div class="form-group text-left">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group text-left">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Số điện thoại" required>
        </div>
        <div class="form-group text-left">
            <label for="address">Địa chỉ</label>
            <select id="address" name="address" class="form-control" required>
                <option value="">Tỉnh/Thành phố</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->name }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group text-left">
            <label for="gender">Giới tính</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="">Chọn giới tính</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
                <option value="other">Khác</option>
            </select>
        </div>
        <div class="form-group text-left">
            <label for="dob">Ngày tháng năm sinh</label>
            <input type="date" id="dob" name="dob" class="form-control" required>
        </div>
        <div class="form-group text-left">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required>
        </div>
        <div class="form-group text-left">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
        </div>
        <div class="form-group form-check text-left">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">Bằng việc Đăng ký, bạn đã đọc và đồng ý với <a href="{{ route('terms') }}">Điều khoản sử dụng</a></label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng ký</button>
        <p class="mt-3 mb-3 text-muted">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
    </form>
</body>
</html>