@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thanh toán</h1>
    <div class="row">
        <!-- Hiển thị thông tin sản phẩm trong giỏ hàng -->
        <div class="col-md-6">
            <h2>Giỏ hàng của bạn</h2>
            <ul class="list-group mb-3">
                @foreach ($cartItems as $item)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($item->store->image_url) }}" alt="{{ $item->store->product_name }}" style="width: 50px; height: 50px; margin-right: 10px;">
                            <div>
                                <div>{{ $item->store->product_name }}</div>
                                <div class="d-flex">
                                    <span class="mr-3">Số lượng: {{ $item->quantity }}</span>
                                    <span>Giá: {{ $item->price * $item->quantity }} đồng</span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <h3>Tổng tiền: {{ $totalPrice }} đồng</h3>
        </div>

        <!-- Form nhập thông tin thanh toán -->
        <div class="col-md-6">
            <h2>Thông tin thanh toán</h2>
            <form action="{{ route('cart.processCheckout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ nhận hàng</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label>Hình thức thanh toán</label>
                    <div>
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" required>
                            <label class="form-check-label d-flex align-items-center" for="cod">
                                <img src="{{ asset('images/cod_logo.png') }}" alt="COD" class="payment-logo">
                                <span class="ml-2">Thanh toán khi nhận hàng</span>
                            </label>
                        </div><br>
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="VNPay" required>
                            <label class="form-check-label d-flex align-items-center" for="vnpay">
                                <img src="{{ asset('images/vnpay_logo.png') }}" alt="VNPay" class="payment-logo">
                                <span class="ml-2">Ví VNPay</span>
                            </label>
                        </div><br>
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="payment_method" id="momo" value="MoMo" required>
                            <label class="form-check-label d-flex align-items-center" for="momo">
                                <img src="{{ asset('images/momo_logo.png') }}" alt="MoMo" class="payment-logo">
                                <span class="ml-2">Ví MoMo</span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
.payment-logo {
    width: 30px;
    height: 30px;
}
</style>
