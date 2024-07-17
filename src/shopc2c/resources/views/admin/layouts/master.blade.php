<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            padding-top: 20px;
        }
        .list-group-item {
            cursor: pointer;
        }
        .table {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('admin.layouts.header')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.sidebar')
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</body>
</html>
