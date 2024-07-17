@extends('admin.layout')

@section('title', 'Quản lý tất cả các gian hàng')

@section('content')
    <div class="row">
        <div class="col">
            <h2>Danh sách tất cả các gian hàng</h2>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên gian hàng</th>
                    <th>Người đăng</th>
                    <th>Địa chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{ $store->title }}</td>
                        <td>{{ $store->user ? $store->user->name : 'Người dùng không tồn tại' }}</td>
                        <td>{{ $store->address }}</td>
                        <td>
                            <form action="{{ route('admin.stores.delete', $store->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa gian hàng này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
