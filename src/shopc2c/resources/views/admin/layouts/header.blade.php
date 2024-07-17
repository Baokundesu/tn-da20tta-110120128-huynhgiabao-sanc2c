<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Custom styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 80px); 
        }
        .sidebar {
            background-color: #333;
            color: #ffffff;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            padding-top: 20px;
        }
        .main-content {
            margin-left: 250px; /* Điều chỉnh margin-left để không bị đè lên bởi sidebar */
            padding: 20px;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link:hover {
            background-color: #555;
        }
        .sidebar .nav-link .nav-icon {
            margin-right: 10px;
        }
        .sidebar .user-panel .info {
            padding: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-black justify-content-center" style="background-color: #333;">
        <!-- DASHBOARD Title -->
        <div class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="logo" class="mr-2">
            <span class="font-weight-bold h4">DASHBOARD</span>
        </div>

        <!-- Sidebar Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="push-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- /.sidebar-toggle -->
    </nav>
    <!-- /.navbar -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
