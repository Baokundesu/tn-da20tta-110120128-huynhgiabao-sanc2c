@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Giỏ hàng của bạn</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($cartItems->isEmpty())
        <p>Giỏ hàng của bạn hiện đang trống.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->store->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.update', ['store' => $item->store_id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;">
                                <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                            </form>
                            <form action="{{ route('cart.delete', ['store' => $item->store_id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $totalPrice = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
        @endphp
        <div class="d-flex justify-content-between align-items-center">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Xóa toàn bộ giỏ hàng</button>
            </form>
            <h4>Tổng tiền: {{ $totalPrice }} đồng</h4>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <form action="{{ route('cart.showCheckout') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success">Thanh toán</button>
            </form>
        </div>
    @endif
</div>
@endsection