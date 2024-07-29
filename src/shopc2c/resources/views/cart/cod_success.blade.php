@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container text-center">
        <div class="alert alert-success">
            <h1>Đặt hàng thành công!</h1>
            <i class="fa fa-check-circle" style="font-size: 5em; color: green;"></i>
            <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn sớm nhất.</p>
        </div>
    </div>
    <h3>Chi tiết đơn hàng:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Tổng giá: {{ number_format($order->total_price, 0, ',', '.') }} VND</h3>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
</div>
@endsection
