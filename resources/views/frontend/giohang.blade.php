@extends('layouts.frontend')

@section('title', 'Giỏ hàng')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.sanpham') }}">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>

        <!-- Items in the cart + Order summary -->
        <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <h1 class="h3 mb-4">Giỏ hàng của bạn</h1>
            <div class="row">
                <!-- Items list -->
                <div class="col-lg-8">
                    <div class="pe-lg-2 pe-xl-3 me-xl-3">
                        <!-- Table of items -->
                        <table class="table position-relative z-2 mb-4">
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-sm fw-normal py-3 ps-0"><span class="text-body">Sản phẩm</span></th>
                                    <th scope="col" class="text-body fs-sm fw-normal py-3 d-none d-xl-table-cell"><span class="text-body">Đơn giá</span></th>
                                    <th scope="col" class="text-body fs-sm fw-normal py-3 d-none d-md-table-cell"><span class="text-body">Số lượng</span></th>
                                    <th scope="col" class="text-body fs-sm fw-normal py-3 d-none d-md-table-cell"><span class="text-body">Thành tiền</span></th>
                                    <th scope="col" class="py-0 px-0">
                                        <div class="nav justify-content-end">
                                            <a href="{{ route('frontend.giohang.xoa', ['row_id' => 'all']) }}" class="nav-link d-inline-block text-decoration-underline text-nowrap py-3 px-0 text-danger">Xóa tất cả</a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                <!-- Item 1 -->
                                <tr>
                                    <td class="py-3 ps-0">
                                        <div class="d-flex align-items-center">
                                            <a class="flex-shrink-0" href="#">
                                                <img src="{{ asset('public/assets/img/shop/02.png') }}" width="100" alt="iPhone 14" />
                                            </a>
                                            <div class="w-100 min-w-0 ps-2 ps-xl-3">
                                                <h5 class="d-flex animate-underline mb-2">
                                                    <a class="d-block fs-sm fw-medium text-truncate animate-target" href="#">Apple iPhone 14 128GB White</a>
                                                </h5>
                                                <ul class="list-unstyled gap-1 fs-xs mb-0">
                                                    <li><span class="text-body-secondary">Màu sắc:</span> <span class="text-dark-emphasis fw-medium">Trắng</span></li>
                                                    <li><span class="text-body-secondary">Dung lượng:</span> <span class="text-dark-emphasis fw-medium">128GB</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="h6 py-3 d-none d-xl-table-cell">21.990.000₫</td>
                                    <td class="py-3 d-none d-md-table-cell">
                                        <div class="d-inline-flex align-items-center border rounded-2">
                                            <a href="{{ route('frontend.giohang.giam', ['row_id' => 1]) }}" class="btn btn-sm btn-icon border-0">
                                                <i class="ci-minus fs-xs"></i>
                                            </a>
                                            <input type="number" class="form-control form-control-sm text-center border-0 p-0" style="width: 2.5rem" value="1" readonly />
                                            <a href="{{ route('frontend.giohang.tang', ['row_id' => 1]) }}" class="btn btn-sm btn-icon border-0">
                                                <i class="ci-plus fs-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="h6 py-3 d-none d-md-table-cell">21.990.000₫</td>
                                    <td class="text-end py-3 px-0">
                                        <a href="{{ route('frontend.giohang.xoa', ['row_id' => 1]) }}" class="btn-close fs-xs" data-bs-toggle="tooltip" data-bs-title="Xóa sản phẩm" aria-label="Xóa"></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="nav justify-content-start pt-2">
                            <a class="nav-link animate-underline px-0" href="{{ route('frontend.sanpham') }}">
                                <i class="ci-chevron-left fs-base me-1"></i>
                                <span class="animate-target">Tiếp tục mua hàng</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Order summary -->
                <aside class="col-lg-4" style="margin-top: -100px">
                    <div class="position-sticky top-0" style="padding-top: 100px">
                        <div class="bg-body-tertiary rounded-5 p-4 mb-3">
                            <div class="p-sm-2 p-lg-0 p-xl-2">
                                <h5 class="border-bottom pb-4 mb-4">Tóm tắt đơn hàng</h5>
                                <ul class="list-unstyled fs-sm gap-3 mb-0">
                                    <li class="d-flex justify-content-between mb-2">
                                        Tạm tính (1 sản phẩm):
                                        <span class="text-dark-emphasis fw-medium">21.990.000₫</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        Giảm giá:
                                        <span class="text-danger fw-medium">-0₫</span>
                                    </li>
                                    <li class="d-flex justify-content-between border-top pt-3 mt-3">
                                        <span class="h6 mb-0">Tổng thanh toán:</span>
                                        <span class="h6 mb-0 text-primary">21.990.000₫</span>
                                    </li>
                                </ul>
                                <div class="pt-4">
                                    <a class="btn btn-lg btn-primary w-100 rounded-pill" href="{{ route('user.dathang') }}">
                                        Tiến hành đặt hàng
                                        <i class="ci-chevron-right fs-lg ms-1 me-n1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection
