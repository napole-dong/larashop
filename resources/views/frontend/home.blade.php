@extends('layouts.frontend')

@section('title', 'Trang chủ')

@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <!-- Hero slider -->
        <section class="container pt-3 mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative">
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark rtl-flip" style="background:linear-gradient(90deg, #accbee 0%, #e7f0fd 100%)"></span>
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark rtl-flip" style="background:linear-gradient(90deg, #1b273a 0%, #1f2632 100%)"></span>
                        <div class="row justify-content-center position-relative z-2">
                            <div class="col-xl-5 col-xxl-4 offset-xxl-1 d-flex align-items-center mt-xl-n3">
                                <!-- Text content master slider -->
                                <div class="swiper px-5 pe-xl-0 ps-xxl-0 me-xl-n5" data-swiper='{"spaceBetween": 64, "loop": true, "speed": 400, "controlSlider": "#sliderImages", "autoplay": {"delay": 5500, "disableOnInteraction": false}, "scrollbar": {"el": ".swiper-scrollbar"}}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Cảm nhận âm thanh thực sự</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Headphones ProMax</h2>
                                            <a class="btn btn-lg btn-primary" href="{{ route('frontend.sanpham') }}">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Ưu đãi trong tuần</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Powerful iPad Pro M2</h2>
                                            <a class="btn btn-lg btn-primary" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-bang']) }}">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Kính thực tế ảo</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Experience New Reality</h2>
                                            <a class="btn btn-lg btn-primary" href="{{ route('frontend.sanpham') }}">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-7">
                                <!-- Binded images (controlled slider) -->
                                <div class="swiper user-select-none" id="sliderImages" data-swiper='{"allowTouchMove": false, "loop": true, "effect": "fade", "fadeEffect": {"crossFade": true}}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('public/assets/img/slider/01.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('public/assets/img/slider/02.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('public/assets/img/slider/03.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Scrollbar -->
                        <div class="row justify-content-center" data-bs-theme="dark">
                            <div class="col-xxl-10">
                                <div class="position-relative mx-5 mx-xxl-0"><div class="swiper-scrollbar mb-4"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brands -->
        <section class="container mb-2">
            <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false">
                <div class="row row-cols-6 g-0" style="min-width:960px">
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/apple-light-mode.svg') }}" class="d-none-dark" alt="Apple" />
                            <img src="{{ asset('public/assets/img/brands/apple-dark-mode.svg') }}" class="d-none d-block-dark" alt="Apple" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/motorola-light-mode.svg') }}" class="d-none-dark" alt="Motorola" />
                            <img src="{{ asset('public/assets/img/brands/motorola-dark-mode.svg') }}" class="d-none d-block-dark" alt="Motorola" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/xiaomi-light-mode.svg') }}" class="d-none-dark" alt="Xiaomi" />
                            <img src="{{ asset('public/assets/img/brands/xiaomi-dark-mode.svg') }}" class="d-none d-block-dark" alt="Xiaomi" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/canon-light-mode.svg') }}" class="d-none-dark" alt="Canon" />
                            <img src="{{ asset('public/assets/img/brands/canon-dark-mode.svg') }}" class="d-none d-block-dark" alt="Canon" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/samsung-light-mode.svg') }}" class="d-none-dark" alt="Samsung" />
                            <img src="{{ asset('public/assets/img/brands/samsung-dark-mode.svg') }}" class="d-none d-block-dark" alt="Samsung" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('public/assets/img/brands/sony-light-mode.svg') }}" class="d-none-dark" alt="Sony" />
                            <img src="{{ asset('public/assets/img/brands/sony-dark-mode.svg') }}" class="d-none d-block-dark" alt="Sony" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @php
            $dienthoai = \App\Models\SanPham::whereHas('LoaiSanPham', fn($q) => $q->where('tenloai_slug', 'dien-thoai'))->take(4)->get();
            $maytinhbang = \App\Models\SanPham::whereHas('LoaiSanPham', fn($q) => $q->where('tenloai_slug', 'may-tinh-bang'))->take(4)->get();
        @endphp

        <!-- Products (Grid) - Điện thoại -->
        <section class="container pt-2 mt-2 mb-3">
            <!-- Heading -->
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
                <h2 class="h3 mb-0">Điện thoại</h2>
                <div class="nav ms-3">
                    <a class="nav-link animate-underline px-0 py-2" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'dien-thoai']) }}">
                        <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Product grid -->
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">
                @if($dienthoai->count() > 0)
                    @foreach($dienthoai as $sp)
                        <div class="col">
                            <div class="product-card animate-underline hover-effect-opacity bg-body rounded h-100 d-flex flex-column">
                                <div class="position-relative">
                                    <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => 'dien-thoai', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                        <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                            @if($sp->hinhanh)
                                                <img src="{{ asset('public/storage/' . $sp->hinhanh) }}" alt="{{ $sp->tensanpham }}" />
                                            @else
                                                <img src="{{ asset('public/assets/img/shop/02.png') }}" alt="{{ $sp->tensanpham }}" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3 mt-auto">
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
                                        <a class="d-block fs-sm fw-medium text-truncate" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => 'dien-thoai', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                            <span class="animate-target">{{ $sp->tensanpham }}</span>
                                        </a>
                                    </h3>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="h5 lh-1 mb-0">{{ number_format($sp->dongia, 0, ',', '.') }}₫</div>
                                        <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2" aria-label="Thêm vào giỏ">
                                            <i class="ci-shopping-cart fs-base animate-target"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col">
                        <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
                            <div class="position-relative">
                                <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="#">
                                    <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                        <img src="{{ asset('public/assets/img/shop/02.png') }}" alt="iPhone 14" />
                                    </div>
                                </a>
                            </div>
                            <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
                                <h3 class="pb-1 mb-2">
                                    <a class="d-block fs-sm fw-medium text-truncate" href="#">
                                        <span class="animate-target">Apple iPhone 14 128GB White</span>
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="h5 lh-1 mb-0">21.990.000₫</div>
                                    <button type="button" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2">
                                        <i class="ci-shopping-cart fs-base animate-target"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Products (Grid) - Máy tính bảng -->
        <section class="container pt-2 mt-2 mb-3">
            <!-- Heading -->
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
                <h2 class="h3 mb-0">Máy tính bảng</h2>
                <div class="nav ms-3">
                    <a class="nav-link animate-underline px-0 py-2" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => 'may-tinh-bang']) }}">
                        <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Product grid -->
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">
                @if($maytinhbang->count() > 0)
                    @foreach($maytinhbang as $sp)
                        <div class="col">
                            <div class="product-card animate-underline hover-effect-opacity bg-body rounded h-100 d-flex flex-column">
                                <div class="position-relative">
                                    <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => 'may-tinh-bang', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                        <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                            @if($sp->hinhanh)
                                                <img src="{{ asset('public/storage/' . $sp->hinhanh) }}" alt="{{ $sp->tensanpham }}" />
                                            @else
                                                <img src="{{ asset('public/assets/img/shop/05.png') }}" alt="{{ $sp->tensanpham }}" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3 mt-auto">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="d-flex gap-1 fs-xs">
                                            <i class="ci-star-filled text-warning"></i>
                                            <i class="ci-star-filled text-warning"></i>
                                            <i class="ci-star-filled text-warning"></i>
                                            <i class="ci-star-filled text-warning"></i>
                                            <i class="ci-star-half text-warning"></i>
                                        </div>
                                        <span class="text-body-tertiary fs-xs">(4)</span>
                                    </div>
                                    <h3 class="pb-1 mb-2">
                                        <a class="d-block fs-sm fw-medium text-truncate" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => 'may-tinh-bang', 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                            <span class="animate-target">{{ $sp->tensanpham }}</span>
                                        </a>
                                    </h3>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="h5 lh-1 mb-0">{{ number_format($sp->dongia, 0, ',', '.') }}₫</div>
                                        <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2" aria-label="Thêm vào giỏ">
                                            <i class="ci-shopping-cart fs-base animate-target"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col">
                        <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
                            <div class="position-relative">
                                <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="#">
                                    <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                        <img src="{{ asset('public/assets/img/shop/05.png') }}" alt="iPad Pro" />
                                    </div>
                                </a>
                            </div>
                            <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
                                <h3 class="pb-1 mb-2">
                                    <a class="d-block fs-sm fw-medium text-truncate" href="#">
                                        <span class="animate-target">Apple iPad Pro M2 11-inch</span>
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="h5 lh-1 mb-0">19.990.000₫</div>
                                    <button type="button" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2">
                                        <i class="ci-shopping-cart fs-base animate-target"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
