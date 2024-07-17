@extends('layouts.app')

@section('title', 'Quản lý gian hàng')

@section('content')
    <div class="row">
        <div class="col">
            <h2>Danh sách gian hàng</h2>
        </div>
        <div class="col text-right">
            <a href="{{ route('store.create') }}" class="btn btn-primary">Thêm gian hàng mới</a>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên gian hàng</th>
                    <th>Địa chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{ $store->title }}</td>
                        <td>{{ $store->address }}</td>
                        <td>
                            <a href="{{ route('manage.stores.edit', $store->id) }}" class="btn btn-sm btn-primary">Chỉnh sửa</a>
                            <form action="{{ route('manage.stores.destroy', $store->id) }}" method="POST" class="d-inline">
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
