@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if ($store->image_url)
                <img src="{{ asset('/' . $store->image_url) }}" alt="Store Image" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/600" alt="No Image Available" class="img-fluid">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $store->title }}</h2>
            <p>{{ $store->description }}</p>
            <p><strong>Đơn vị tính:</strong> {{ $store->unit }}</p>
            <p><strong>Xuất xứ:</strong> {{ $store->origin }}</p>
            <p><strong>Địa chỉ:</strong> {{ $store->address }}</p>
            <p><strong>Giá bán:</strong> 
                @if($store->is_free)
                    Miễn phí
                @else
                    {{ number_format($store->price, 0, ',', '.') }} đồng
                @endif
            </p>
            <div class="mt-4">
                <form action="{{ route('cart.add', ['store' => $store->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $store->id }}">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control mb-2" style="width: 100px;">
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>                
                {{-- <br>
                <button class="btn btn-success">Mua ngay</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection
