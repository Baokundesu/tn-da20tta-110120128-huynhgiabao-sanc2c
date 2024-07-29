@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Quản lý đơn hàng</h2>
    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>                        
                        <th>Ngày đặt hàng</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <ul>
                                    @foreach($order->orderItems as $item)
                                        <li>{{ $item->product_name }} - Số lượng: {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
