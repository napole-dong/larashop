@extends('layouts.frontend')

@section('title', 'Sản phẩm')

@section('content')
    @php
        $currentSlug = request()->route('tenloai_slug');
        $query = \App\Models\SanPham::query();
        if ($currentSlug) {
            $query->whereHas('LoaiSanPham', fn($q) => $q->where('tenloai_slug', $currentSlug));
        }
        if (request()->has('q') && request()->q != '') {
            $query->where('tensanpham', 'like', '%' . request()->q . '%');
        }
        $sanpham = $query->paginate(12);
        $loaisanpham = \App\Models\LoaiSanPham::all();
    @endphp

    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.sanpham') }}">Sản phẩm</a></li>
                @if($currentSlug)
                    <li class="breadcrumb-item active" aria-current="page">{{ $loaisanpham->where('tenloai_slug', $currentSlug)->first()->tenloai ?? $currentSlug }}</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
                @endif
            </ol>
        </nav>

        <!-- Page title -->
        <div class="container mb-4">
            <h1 class="h3 mb-1">
                @if($currentSlug)
                    {{ $loaisanpham->where('tenloai_slug', $currentSlug)->first()->tenloai ?? 'Danh mục sản phẩm' }}
                @else
                    Tất cả danh mục sản phẩm
                @endif
            </h1>
            <p class="text-body-secondary fs-sm mb-0">Tìm thấy {{ $sanpham->total() }} sản phẩm phù hợp</p>
        </div>

        <!-- Category cards (Cartzilla categories) -->
        <section class="container mb-5">
            <div class="row row-cols-1 row-cols-sm-3 g-4">
                <div class="col">
                    <div class="hover-effect-scale bg-body-tertiary rounded-4 p-4 text-center {{ $currentSlug == 'dien-thoai' ? 'border border-primary' : '' }}">
                        <a class="d-block mb-3" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'dien-thoai']) }}">
                            <div class="ratio ratio-1x1 mx-auto" style="max-width: 140px">
                                <img src="{{ asset('public/assets/img/shop/02.png') }}" class="hover-effect-target object-fit-contain" alt="Điện thoại" />
                            </div>
                        </a>
                        <h2 class="h6 mb-1">
                            <a class="animate-underline animate-target d-inline text-truncate text-dark-emphasis" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'dien-thoai']) }}">Điện thoại thông minh</a>
                        </h2>
                        <span class="fs-xs text-body-tertiary">iPhone, Samsung, Xiaomi</span>
                    </div>
                </div>

                <div class="col">
                    <div class="hover-effect-scale bg-body-tertiary rounded-4 p-4 text-center {{ $currentSlug == 'may-tinh-bang' ? 'border border-primary' : '' }}">
                        <a class="d-block mb-3" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-bang']) }}">
                            <div class="ratio ratio-1x1 mx-auto" style="max-width: 140px">
                                <img src="{{ asset('public/assets/img/shop/05.png') }}" class="hover-effect-target object-fit-contain" alt="Máy tính bảng" />
                            </div>
                        </a>
                        <h2 class="h6 mb-1">
                            <a class="animate-underline animate-target d-inline text-truncate text-dark-emphasis" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-bang']) }}">Máy tính bảng</a>
                        </h2>
                        <span class="fs-xs text-body-tertiary">iPad, Galaxy Tab</span>
                    </div>
                </div>

                <div class="col">
                    <div class="hover-effect-scale bg-body-tertiary rounded-4 p-4 text-center {{ $currentSlug == 'may-tinh-xach-tay' ? 'border border-primary' : '' }}">
                        <a class="d-block mb-3" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-xach-tay']) }}">
                            <div class="ratio ratio-1x1 mx-auto" style="max-width: 140px">
                                <img src="{{ asset('public/assets/img/shop/macbook.png') }}" class="hover-effect-target object-fit-contain" alt="Laptop" />
                            </div>
                        </a>
                        <h2 class="h6 mb-1">
                            <a class="animate-underline animate-target d-inline text-truncate text-dark-emphasis" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-xach-tay']) }}">Máy tính xách tay</a>
                        </h2>
                        <span class="fs-xs text-body-tertiary">MacBook, Dell, Asus, HP</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product grid -->
        <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($sanpham as $sp)
                    <div class="col">
                        <div class="product-card animate-underline hover-effect-opacity bg-body rounded h-100 d-flex flex-column border">
                            <div class="position-relative">
                                <a class="d-block rounded-top overflow-hidden p-3 p-sm-4 text-center" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $sp->LoaiSanPham->tenloai_slug ?? 'dien-thoai', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                    <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                        @if($sp->hinhanh)
                                            <img src="{{ asset('public/storage/' . $sp->hinhanh) }}" class="object-fit-contain" alt="{{ $sp->tensanpham }}" />
                                        @else
                                            <img src="{{ asset('public/assets/img/shop/02.png') }}" class="object-fit-contain" alt="{{ $sp->tensanpham }}" />
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="w-100 min-w-0 px-2 pb-3 px-sm-3 pb-sm-3 mt-auto">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="d-flex gap-1 fs-xs">
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-half text-warning"></i>
                                    </div>
                                    <span class="text-body-tertiary fs-xs">(5)</span>
                                </div>
                                <h3 class="pb-1 mb-2">
                                    <a class="d-block fs-sm fw-medium text-truncate text-dark-emphasis" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $sp->LoaiSanPham->tenloai_slug ?? 'dien-thoai', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                        <span class="animate-target">{{ $sp->tensanpham }}</span>
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="h6 lh-1 mb-0 text-primary">{{ number_format($sp->dongia, 0, ',', '.') }}₫</div>
                                    <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2" aria-label="Thêm vào giỏ">
                                        <i class="ci-shopping-cart fs-base animate-target"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="fs-lg text-secondary">Không tìm thấy sản phẩm nào trong mục này.</p>
                        <a href="{{ route('frontend.sanpham') }}" class="btn btn-outline-primary">Xem tất cả sản phẩm</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center pt-4 mt-2">
                {{ $sanpham->links('pagination::bootstrap-5') }}
            </div>
        </section>
    </main>
@endsection
