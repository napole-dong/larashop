@extends('layouts.frontend')

@section('title', 'Đặt hàng thành công')

@section('content')
    <main class="content-wrapper">
        <div class="row row-cols-1 row-cols-lg-2 g-0 mx-auto" style="max-width: 1920px">
            <!-- Thank you content column -->
            <div class="col d-flex flex-column justify-content-center py-5 px-xl-4 px-xxl-5">
                <div class="w-100 pt-sm-2 pt-md-3 pt-lg-4 pb-lg-4 pb-xl-5 px-3 px-sm-4 pe-lg-0 ps-lg-5 mx-auto ms-lg-auto me-lg-4" style="max-width: 740px">
                    <div class="d-flex align-items-sm-center border-bottom pb-4 pb-md-5">
                        <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle flex-shrink-0" style="width: 3.5rem; height: 3.5rem">
                            <i class="ci-check fs-2"></i>
                        </div>
                        <div class="w-100 ps-3 ps-sm-4">
                            <div class="fs-sm text-body-tertiary mb-1">Mã đơn hàng: #{{ rand(100000, 999999) }}</div>
                            <h1 class="h3 mb-0">Cảm ơn bạn đã đặt hàng!</h1>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-4 pt-4 pb-5">
                        <div>
                            <h3 class="h6 mb-2">Trạng thái đơn hàng</h3>
                            <p class="fs-sm text-secondary mb-0">
                                Đơn hàng của bạn đã được tiếp nhận và nhân viên cửa hàng sẽ liên hệ xác nhận trong thời gian sớm nhất.
                            </p>
                        </div>
                        <div>
                            <h3 class="h6 mb-2">Thời gian giao hàng dự kiến</h3>
                            <p class="fs-sm text-secondary mb-0">Từ 2 - 4 ngày làm việc (không tính Thứ Bảy & Chủ Nhật).</p>
                        </div>
                        <div>
                            <h3 class="h6 mb-2">Phương thức thanh toán</h3>
                            <p class="fs-sm text-secondary mb-0">Thanh toán tiền mặt khi nhận hàng (COD).</p>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a class="btn btn-lg btn-primary rounded-pill px-4" href="{{ route('user.donhang') }}">
                            <i class="ci-shopping-bag me-2"></i> Xem đơn hàng của tôi
                        </a>
                        <a class="btn btn-lg btn-outline-secondary rounded-pill px-4" href="{{ route('frontend.home') }}">
                            Về trang chủ
                        </a>
                    </div>

                    <p class="fs-sm pt-4 mt-2 mb-0 text-body-secondary">
                        Bạn cần trợ giúp?
                        <a class="fw-medium text-primary text-decoration-underline ms-1" href="{{ route('frontend.lienhe') }}">Liên hệ hỗ trợ</a>
                    </p>
                </div>
            </div>

            <!-- Promotion / Right column -->
            <div class="col pt-sm-3 p-md-5 ps-lg-5 py-lg-4 pe-lg-4 p-xxl-5">
                <div class="position-relative d-flex align-items-center h-100 py-5 px-3 px-sm-4 px-xl-5">
                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary rounded-5 d-none d-md-block"></span>
                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary d-md-none"></span>
                    <div class="position-relative w-100 z-2 mx-auto" style="max-width: 500px">
                        <div class="text-center">
                            <span class="badge bg-success-subtle text-success fs-sm px-3 py-2 rounded-pill mb-3">Ưu đãi thành viên</span>
                            <h2 class="h3 mb-2">🎉 Chúc mừng bạn nhận được mã giảm giá 10%!</h2>
                            <p class="fs-sm text-secondary mb-4">Sử dụng mã bên dưới cho đơn hàng tiếp theo tại cửa hàng.</p>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control text-center fw-bold fs-5 bg-white" value="LARASHOP2026" readonly />
                            </div>
                            <a href="{{ route('frontend.sanpham') }}" class="btn btn-outline-dark rounded-pill">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
