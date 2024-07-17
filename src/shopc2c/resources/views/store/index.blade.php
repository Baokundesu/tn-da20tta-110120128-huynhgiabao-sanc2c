@include('layouts.header')

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($stores as $store)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Store image-->
                    <img class="card-img-top" src="{{ asset($store->image_url) }}" alt="Store Image" />
                    <!-- Store details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Store title-->
                            <h5 class="fw-bolder">{{ $store->title }}</h5>
                            <!-- Store price-->
                            @if($store->is_free)
                                <span>Cho tặng</span>
                            @else
                                <span>Giá: {{ number_format($store->price, 0, ',', '.') }} đồng</span>
                            @endif
                        </div>
                    </div>
                    <!-- Store actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('store.show', $store->id) }}">Xem chi tiết</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $stores->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        .card-img-top {
            height: 250px; 
            object-fit: cover; 
        }
        .pagination {
            margin-top: 20px;
        }
    </style>
</section>

@include('layouts.footer')