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
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            margin-left: 250px;
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
<body>
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    @if(auth()->check())
                        <a href="#" class="d-block">{{ auth()->user()->username }}</a>
                    @endif
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            Quản lý người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.pending') }}" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            Duyệt bài đăng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th-list"></i>
                            Quản lý bài đăng
                        </a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('admin.login') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                Đăng nhập
                            </a>
                        </li>
                    @else
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
                    @endguest
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </aside>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
