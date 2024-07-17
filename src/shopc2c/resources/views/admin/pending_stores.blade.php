@extends('admin.layout')

@section('title', 'Gian hàng đang chờ duyệt')

@section('content')
    <div class="row">
        <div class="col">
            <h2>Danh sách gian hàng đang chờ duyệt</h2>
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
                        <td>{{ $store->user->name }}</td>
                        <td>{{ $store->address }}</td>
                        <td>
                            <form action="{{ route('admin.stores.approve', $store->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Bạn có chắc chắn muốn duyệt gian hàng này không?')">Duyệt</button>
                            </form>
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
