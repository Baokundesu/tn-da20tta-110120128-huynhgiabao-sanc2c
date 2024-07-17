<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-header {
            background-color: #333;
            color: #fff;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .main-header .navbar-brand {
            display: flex;
            align-items: center;
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
            z-index: 1000;
        }
        .content-wrapper {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .main-footer {
            background-color: #333;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            width: calc(100% - 250px);
            margin-left: 250px;
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
        .mr-2 {
            height: 250px; 
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-black justify-content-center">
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

        <!-- Main Sidebar Container -->
        <aside class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    @auth('admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                Quản lý người dùng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stores.pending') }}" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                Duyệt bài đăng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stores') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                Quản lý bài đăng
                            </a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                Đăng xuất
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('admin.login') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                Đăng nhập
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-left">
                <strong>Copyright &copy; 2024 .</strong>
                All rights reserved.
            </div>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
        <!-- /.footer -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
