@extends('layouts.frontend')

@section('title', 'Đặt hàng & Thanh toán')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.giohang') }}">Giỏ hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
            </ol>
        </nav>

        <div class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <h1 class="h3 mb-4">Thông tin thanh toán & đặt hàng</h1>

            <form action="{{ route('user.dathang') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <!-- Form fields -->
                    <div class="col-lg-8">
                        <div class="pe-lg-4 pe-xl-0">
                            <!-- Shipping address -->
                            <div class="card border rounded-4 p-4 mb-4">
                                <h2 class="h5 mb-4">1. Địa chỉ giao hàng</h2>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="hoten" class="form-label">Họ và tên người nhận</label>
                                        <input type="text" class="form-control form-control-lg" id="hoten" name="hoten" value="{{ Auth::user()->name ?? '' }}" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="dienthoai" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control form-control-lg" id="dienthoai" name="dienthoai" placeholder="0912 345 678" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="diachi" class="form-label">Địa chỉ nhận hàng</label>
                                        <input type="text" class="form-control form-control-lg" id="diachi" name="diachi" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="ghichu" class="form-label">Ghi chú đơn hàng (tùy chọn)</label>
                                        <textarea class="form-control" id="ghichu" name="ghichu" rows="3" placeholder="Ghi chú về thời gian giao hàng hoặc địa điểm..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment methods -->
                            <div class="card border rounded-4 p-4 mb-4">
                                <h2 class="h5 mb-4">2. Phương thức thanh toán</h2>
                                <div class="d-flex flex-column gap-3">
                                    <div class="form-check border rounded-3 p-3 mb-0">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="phuongthucthanhtoan" id="cod" value="cod" checked />
                                        <label class="form-check-label d-flex align-items-center w-100" for="cod">
                                            <span class="fw-semibold text-dark-emphasis">Thanh toán khi nhận hàng (COD)</span>
                                            <span class="text-body-secondary fs-sm ms-auto">Tiền mặt</span>
                                        </label>
                                    </div>

                                    <div class="form-check border rounded-3 p-3 mb-0">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="phuongthucthanhtoan" id="banking" value="banking" />
                                        <label class="form-check-label d-flex align-items-center w-100" for="banking">
                                            <span class="fw-semibold text-dark-emphasis">Chuyển khoản qua ngân hàng (QR Code)</span>
                                            <img src="{{ asset('public/assets/img/payment-methods/visa-light-mode.svg') }}" class="ms-auto d-none-dark" alt="Visa" />
                                            <img src="{{ asset('public/assets/img/payment-methods/visa-dark-mode.svg') }}" class="ms-auto d-none d-block-dark" alt="Visa" />
                                        </label>
                                    </div>

                                    <div class="form-check border rounded-3 p-3 mb-0">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="phuongthucthanhtoan" id="vnpay" value="vnpay" />
                                        <label class="form-check-label d-flex align-items-center w-100" for="vnpay">
                                            <span class="fw-semibold text-dark-emphasis">Thanh toán qua VNPAY / Ví điện tử</span>
                                            <img src="{{ asset('public/assets/img/payment-methods/mastercard.svg') }}" class="ms-auto" alt="Mastercard" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <aside class="col-lg-4">
                        <div class="bg-body-tertiary rounded-5 p-4 position-sticky top-0" style="top: 100px">
                            <h5 class="border-bottom pb-4 mb-4">Đơn hàng của bạn</h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="ratio ratio-1x1 rounded overflow-hidden flex-shrink-0" style="width: 70px">
                                    <img src="{{ asset('public/assets/img/shop/02.png') }}" alt="iPhone 14" />
                                </div>
                                <div class="w-100 min-w-0 ps-3">
                                    <h6 class="fs-sm mb-1 text-truncate">Apple iPhone 14 128GB White</h6>
                                    <div class="fs-xs text-body-tertiary">Số lượng: 1</div>
                                    <div class="fs-sm fw-semibold text-primary">21.990.000₫</div>
                                </div>
                            </div>

                            <ul class="list-unstyled fs-sm gap-2 border-top pt-3 mb-4">
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span class="fw-medium text-dark-emphasis">21.990.000₫</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Phí giao hàng:</span>
                                    <span class="text-success fw-medium">Miễn phí</span>
                                </li>
                                <li class="d-flex justify-content-between border-top pt-3 mt-2">
                                    <span class="h6 mb-0">Tổng cộng:</span>
                                    <span class="h5 mb-0 text-primary">21.990.000₫</span>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-lg btn-primary w-100 rounded-pill">
                                Xác nhận đặt hàng
                                <i class="ci-chevron-right fs-base ms-1 me-n1"></i>
                            </button>
                        </div>
                    </aside>
                </div>
            </form>
        </div>
    </main>
@endsection
