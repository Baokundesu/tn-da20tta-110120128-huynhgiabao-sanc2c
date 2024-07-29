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
</div>
@endsection