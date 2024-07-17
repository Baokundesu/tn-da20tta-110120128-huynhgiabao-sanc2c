<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sàn giao dịch nông sản</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        .banner-header {
            position: relative;
            background-image: url('{{ asset('images/banner1.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 400px; /* Điều chỉnh chiều cao của banner theo ý muốn */
        }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('home') }}">Nông sản</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="filterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bộ lọc
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option" href="{{ route('home', ['type' => 'all']) }}" data-type="all">Tất cả sản phẩm</a></li>
                            <li><a class="dropdown-item filter-option" href="{{ route('store.filter.by.type', ['type' => 'rau_cu']) }}" data-type="rau_cu_qua">Rau củ</a></li>
                            <li><a class="dropdown-item filter-option" href="{{ route('store.filter.by.type', ['type' => 'trai_cay']) }}" data-type="trai_cay">Trái cây</a></li>
                            <li><a class="dropdown-item filter-option" href="{{ route('store.filter.by.type', ['type' => 'dua_muoi']) }}" data-type="dua_muoi">Dưa muối</a></li>
                            <li><a class="dropdown-item filter-option" href="{{ route('store.filter.by.type', ['type' => 'lua_gao']) }}" data-type="lua_gao">Lúa gạo</a></li>
                        </ul>
                    </li>
                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('manage.stores.index') }}">Quản lý gian hàng</a></li>
                    @endauth
                </ul>
                <div class="d-flex">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark me-2">
                        <i class="bi-cart-fill"></i>
                        Giỏ hàng
                        <span class="fa fa-shopping-cart"></span>
                    </a>
                </div>
                <div class="d-flex">
                    @auth
                    <!-- Menu dropdown cho người dùng đã đăng nhập -->
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle ms-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-person"></i>
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Thông tin người dùng</a></li>
                            <li><a class="dropdown-item" href="{{ route('store.create') }}">Đăng kí gian hàng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <!-- Nút login cho người dùng chưa đăng nhập -->
                    <a href="{{ route('login') }}" class="btn btn-outline-dark ms-2">
                        <i class="bi-person"></i>
                        Login
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="banner-header"></header>

    <!-- Thêm JavaScript để chuyển đổi banner và chuyển trang sau vài giây -->
    <script>
        // Danh sách các banner
        const banners = [
            { image: "{{ asset('images/banner1.jpg') }}", url: "#" },
            { image: "{{ asset('images/banner2.jpg') }}", url: "#" },
            { image: "{{ asset('images/banner3.jpg') }}", url: "#" }
        ];

        let currentBannerIndex = 0;

        function changeBanner() {
            const banner = banners[currentBannerIndex];
            document.querySelector('.banner-header').style.backgroundImage = `url(${banner.image})`;
            currentBannerIndex = (currentBannerIndex + 1) % banners.length;
        }

        // Thay đổi banner sau mỗi 3 giây
        setInterval(changeBanner, 3000);

        // JavaScript cho bộ lọc sản phẩm
        document.addEventListener('DOMContentLoaded', function () {
            const filterDropdown = document.getElementById('filterDropdown');
            const filterOptions = document.querySelectorAll('.dropdown-menu .dropdown-item');

            filterOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    const selectedType = this.dataset.type;
                    if (selectedType === 'all') {
                        filterDropdown.textContent = 'Tất cả sản phẩm';
                    } else {
                        filterDropdown.textContent = this.textContent.trim();
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>