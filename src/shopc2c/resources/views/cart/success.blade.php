@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="alert alert-success">
        <h1>Đặt hàng thành công!</h1>
        <i class="fa fa-check-circle" style="font-size: 5em; color: green;"></i>
        <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn sớm nhất.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
    </div>
</div>
@endsection
