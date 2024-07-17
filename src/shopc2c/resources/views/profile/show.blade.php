@extends('layouts.app')

@section('title', 'Thông tin người dùng')

@section('content')
<div class="container d-flex">
    <!-- Phần thông tin người dùng -->
    <div class="left-column flex-fill mr-4">
        <h1 class="mb-4">Thông tin người dùng</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>
        
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
        
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" readonly>
            </div>
        
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ $user->address }}" readonly>
            </div>

            <div class="form-group text-center">
                <label for="change_password">Đổi mật khẩu</label>
            </div>
        
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>

    <!-- Phần đơn hàng chờ xác nhận -->
    <div class="right-column flex-fill">
        <h2>Đơn hàng chờ xác nhận</h2>
        @if ($pendingOrders->isEmpty())
            <p>Không có đơn hàng nào đang chờ xác nhận.</p>
        @else
            <ul>
                @foreach ($pendingOrders as $order)
                    <li>
                        <h3>Đơn hàng #{{ $order->id }}</h3>
                        <p>Trạng thái: {{ $order->status }}</p>
                        <ul>
                            @foreach ($order->items as $item)
                                <li>{{ $item->product_name }} - {{ $item->quantity }} x {{ $item->price }} VND</li>
                            @endforeach
                        </ul>
                        @if ($order->status == 'pending')
                            <form action="{{ route('order.user-cancel', $order->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="reason">Lý do hủy:</label>
                                    <select name="reason" id="reason" class="form-control">
                                        <option value="Hết hàng">Hết hàng</option>
                                        <option value="Lý do thời tiết">Lý do thời tiết</option>
                                        <option value="Lý do vận chuyển">Lý do vận chuyển</option>
                                        <option value="Lý do khác">Lý do khác</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm">Hủy đơn hàng</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{ $pendingOrders->links() }}
        @endif
    </div>
</div>
@endsection