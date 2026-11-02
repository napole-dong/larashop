@extends('layouts.frontend')

@php
    $slug = request()->route('tensanpham_slug');
    $sp = null;
    if ($slug) {
        $sp = \App\Models\SanPham::where('tensanpham_slug', $slug)->first();
    }
    if (!$sp) {
        $sp = \App\Models\SanPham::first();
    }
@endphp

@section('title', $sp->tensanpham ?? 'Chi tiết sản phẩm')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.sanpham') }}">Sản phẩm</a></li>
                @if($sp && $sp->LoaiSanPham)
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => $sp->LoaiSanPham->tenloai_slug]) }}">{{ $sp->LoaiSanPham->tenloai }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $sp->tensanpham ?? 'Chi tiết' }}</li>
            </ol>
        </nav>

        <!-- Page title -->
        <h1 class="h3 container mb-4">{{ $sp->tensanpham ?? 'Sản phẩm' }}</h1>

        <!-- Product details -->
        <section class="container pb-5 mb-1 mb-sm-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="row gy-4">
                <!-- Gallery -->
                <div class="col-md-6">
                    <div class="bg-body-tertiary rounded-4 p-4 text-center">
                        <div class="ratio ratio-1x1 mx-auto" style="max-width: 450px">
                            @if($sp && $sp->hinhanh)
                                <img src="{{ asset('public/storage/' . $sp->hinhanh) }}" class="object-fit-contain" alt="{{ $sp->tensanpham }}" />
                            @else
                                <img src="{{ asset('public/assets/img/shop/02.png') }}" class="object-fit-contain" alt="Product" />
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product options -->
                <div class="col-md-6">
                    <div class="ps-md-4 ps-xl-5">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="d-flex gap-1 fs-sm">
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-half text-warning"></i>
                            </div>
                            <span class="text-body-tertiary fs-xs">(4.8 / 5 - 128 đánh giá)</span>
                            <span class="badge bg-success-subtle text-success ms-auto">Còn hàng</span>
                        </div>

                        <!-- Price -->
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="h2 mb-0 text-primary">{{ number_format($sp->dongia ?? 0, 0, ',', '.') }}₫</div>
                            <span class="text-body-tertiary text-decoration-line-through fs-lg">
                                {{ number_format(($sp->dongia ?? 0) * 1.1, 0, ',', '.') }}₫
                            </span>
                        </div>

                        <!-- Attributes -->
                        <div class="d-flex flex-column gap-3 pb-4 mb-3 border-bottom">
                            <div>
                                <span class="text-body-secondary fs-sm">Hãng sản xuất:</span>
                                <span class="fw-semibold ms-2">{{ $sp->HangSanXuat->tenhang ?? 'Chính hãng' }}</span>
                            </div>
                            <div>
                                <span class="text-body-secondary fs-sm">Loại sản phẩm:</span>
                                <span class="fw-semibold ms-2">{{ $sp->LoaiSanPham->tenloai ?? 'Thiết bị di động' }}</span>
                            </div>
                            <div>
                                <span class="text-body-secondary fs-sm">Tình trạng kho:</span>
                                <span class="fw-semibold ms-2 text-success">{{ $sp->soluong ?? 100 }} sản phẩm có sẵn</span>
                            </div>
                        </div>

                        <!-- Add to cart CTA -->
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug ?? '']) }}" class="btn btn-lg btn-primary flex-grow-1 animate-slide-end">
                                <i class="ci-shopping-cart fs-lg animate-target ms-n1 me-2"></i>
                                Thêm vào giỏ hàng
                            </a>
                            <a href="{{ route('user.dathang') }}" class="btn btn-lg btn-dark">
                                Mua ngay
                            </a>
                        </div>

                        <!-- Benefits -->
                        <div class="card bg-body-tertiary border-0 rounded-4 p-3 p-xl-4 mb-4">
                            <div class="d-flex flex-column gap-3 fs-sm">
                                <div class="d-flex align-items-center">
                                    <i class="ci-delivery text-primary fs-lg me-3"></i>
                                    <span>Giao hàng miễn phí toàn quốc cho đơn từ 500.000₫</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="ci-refresh-cw text-primary fs-lg me-3"></i>
                                    <span>Đổi trả miễn phí trong vòng 30 ngày nếu phát sinh lỗi</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="ci-shield-check text-primary fs-lg me-3"></i>
                                    <span>Bảo hành chính hãng 12 tháng tại các trung tâm ủy quyền</span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <h3 class="h5 mb-3">Mô tả sản phẩm</h3>
                            <div class="fs-sm text-secondary">
                                {!! nl2br(e($sp->motasanpham ?? 'Sản phẩm chính hãng, mới 100% nguyên hộp đầy đủ phụ kiện. Thiết kế sang trọng, hiệu năng mạnh mẽ, đáp ứng hoàn hảo mọi nhu cầu học tập, làm việc và giải trí.')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
