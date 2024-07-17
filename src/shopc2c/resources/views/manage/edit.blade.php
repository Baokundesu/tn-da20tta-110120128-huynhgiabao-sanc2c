@extends('layouts.app')

@section('title', 'Chỉnh sửa gian hàng')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chỉnh sửa gian hàng</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('manage.stores.update', $store->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Tiêu đề</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $store->title }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">Tên sản phẩm</label>
                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $store->product_name }}" required>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Địa chỉ</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $store->address }}" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Giá</label>
                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $store->price }}" {{ $store->is_free ? 'disabled' : '' }} required>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_free" onclick="togglePriceField()" name="is_free" {{ $store->is_free ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_free">Tôi muốn cho tặng miễn phí</label>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cập nhật
                                </button>
                                <a href="{{ route('manage.stores.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePriceField() {
        var isFreeCheckbox = document.getElementById("is_free");
        var priceField = document.getElementById("price");
        
        if (isFreeCheckbox.checked) {
            if (priceField.value !== '') {
                priceField.value = '';
            }
            priceField.setAttribute("disabled", true);
        } else {
            priceField.removeAttribute("disabled");
        }
    }
</script>
@endsection
