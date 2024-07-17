@extends('layouts.app')

@section('title', 'Đăng ký gian hàng')

@section('content')
<div class="container" style="width: 80%; max-width: 800px; margin: 0 auto;">
    <h1 class="mb-4">Đăng ký gian hàng</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h2>Thông tin chi tiết</h2>

        <div class="form-group">
            <label for="product_name">Tên sản phẩm</label>
            <input type="text" id="product_name" name="product_name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="type">Loại hàng</label>
            <select id="type" name="type" class="form-control">
                <option value="rau_cu">Rau củ</option>
                <option value="trai_cay">Trái cây</option>
                <option value="dua_muoi">Dưa muối</option>
                <option value="lua_gao">Lúa gạo</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="origin">Xuất xứ</label>
            <input type="text" id="origin" name="origin" class="form-control">
        </div>
        
        <div class="form-group">
            <div>
                <input type="checkbox" id="is_free" name="is_free" value="1" onclick="togglePriceField()">
                <label for="is_free">Tôi muốn cho tặng miễn phí</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="price">Giá bán (VNĐ)</label>
            <input type="number" id="price" name="price" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="unit">Đơn vị tính</label>
            <div>
                <label><input type="checkbox" name="unit" value="kg"> kg</label>
                <label><input type="checkbox" name="unit" value="trai"> Trái</label>
                <label><input type="checkbox" name="unit" value="cu"> Củ</label>
                <label><input type="checkbox" name="unit" value="chuc"> Chục</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="address">Địa chỉ chi tiết</label>
            <input type="text" id="address" name="address" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <hr>

        <h2>Tiêu đề đăng tin</h2>
        <div class="form-group">
            <label for="title">Tiêu đề đăng tin</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả chi tiết sản phẩm</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>

<script>
    function togglePriceField() {
        var isFreeCheckbox = document.getElementById("is_free");
        var priceField = document.getElementById("price");
        
        if (isFreeCheckbox.checked) {
            if (priceField.value !== '') {
                priceField.value = '';
            }
            priceField.setAttribute("disabled", true);
        } else {
            priceField.removeAttribute("disabled");
        }
    }
</script>
@endsection
