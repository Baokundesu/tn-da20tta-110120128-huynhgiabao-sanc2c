@include('layouts.header')

<!-- Inline CSS for styling -->
<style>
    .card {
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>

<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($stores as $store)
            <div class="col mb-5">
                <div class="card h-100 shadow-sm">
                    <!-- Store image-->
                    <img class="card-img-top" src="{{ asset($store->image_url) }}" alt="Store Image" />
                    <!-- Store details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Store title-->
                            <h5 class="fw-bolder">{{ $store->title }}</h5>
                            <!-- Store price-->
                            @if($store->is_free)
                                <span class="text-success">Cho tặng</span>
                            @else
                                <span class="text-danger">Giá: {{ number_format($store->price, 0, ',', '.') }} đồng</span>
                            @endif
                        </div>
                    </div>
                    <!-- Store actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-primary mt-auto" href="{{ route('store.show', $store->id) }}">Xem chi tiết</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $stores->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

@include('layouts.footer')
