@extends('layouts.frontend')

@section('title', 'Đơn hàng của tôi')

@section('content')
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Khách hàng</a></li>
                <li class="breadcrumb-item active">Đơn hàng của tôi</li>
            </ol>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar navigation -->
                <aside class="col-lg-3">
                    <div class="offcanvas-lg offcanvas-start pe-lg-0 pe-xl-4" id="accountSidebar">
                        <!-- Header -->
                        <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                            <div class="d-flex align-items-center">
                                <div class="h5 d-flex justify-content-center align-items-center flex-shrink-0 text-primary bg-primary-subtle lh-1 rounded-circle mb-0" style="width:3rem; height:3rem">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0 ps-3">
                                    <h5 class="h6 mb-0">{{ Auth::user()->name ?? 'Khách hàng' }}</h5>
                                    <div class="nav flex-nowrap text-nowrap min-w-0">
                                        <a class="nav-link animate-underline text-body p-0" href="{{ route('user.home') }}">
                                            <span class="text-body fw-normal text-truncate mt-1">Khách hàng thân thiết</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar"></button>
                        </div>
                        <!-- Body (Navigation) -->
                        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                            <nav class="list-group list-group-borderless">
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('user.hoso') }}">
                                    <i class="ci-user fs-base opacity-75 me-2"></i> Hồ sơ cá nhân
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center active pe-none" href="{{ route('user.donhang') }}">
                                    <i class="ci-shopping-bag fs-base opacity-75 me-2"></i> Đơn hàng của tôi
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-heart fs-base opacity-75 me-2"></i> Sản phẩm yêu thích
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-star fs-base opacity-75 me-2"></i> Đánh giá sản phẩm
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                                    <i class="ci-map-pin fs-base opacity-75 me-2"></i> Sổ địa chỉ
                                </a>
                            </nav>
                            <nav class="list-group list-group-borderless pt-3">
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="ci-log-out fs-base opacity-75 me-2"></i> Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Orders content -->
                <div class="col-lg-9">
                    <div class="ps-lg-3 ps-xl-0">
                        <h1 class="h2 mb-4">Lịch sử đơn hàng</h1>

                        @php
                            $user = Auth::user();
                            $donhang = $user ? \App\Models\DonHang::where('user_id', $user->id)->latest()->get() : collect();
                        @endphp

                        @if($donhang->count() > 0)
                            <div class="d-flex flex-column gap-3">
                                @foreach($donhang as $dh)
                                    <div class="card border rounded-4 p-4">
                                        <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                            <div>
                                                <span class="text-body-secondary fs-xs">Mã đơn hàng:</span>
                                                <span class="h6 mb-0 ms-1">#{{ str_pad($dh->id, 6, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 mt-2 mt-sm-0">
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ $dh->TinhTrang->tentinhtrang ?? 'Đang xử lý' }}
                                                </span>
                                                <span class="text-body-tertiary fs-xs">
                                                    {{ $dh->created_at ? $dh->created_at->format('d/m/Y H:i') : '' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-2 mb-3">
                                            <div class="fs-sm"><strong>Người nhận:</strong> {{ $dh->diachigiaohang ?? ($user->name ?? '') }}</div>
                                            <div class="fs-sm"><strong>Số điện thoại:</strong> {{ $dh->dienthoaigiaohang ?? 'Chưa cập nhật' }}</div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                            <div>
                                                <span class="fs-sm text-body-secondary">Tổng thanh toán:</span>
                                                <span class="h6 mb-0 text-primary ms-2">{{ number_format($dh->DonHang_ChiTiet->sum(fn($ct) => $ct->soluongban * $ct->dongiaban), 0, ',', '.') }}₫</span>
                                            </div>
                                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('user.donhang.chitiet', ['id' => $dh->id]) }}">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card border-0 bg-body-tertiary rounded-4 text-center py-5 px-3">
                                <div class="d-inline-flex bg-body text-primary rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; align-items: center; justify-content: center">
                                    <i class="ci-shopping-bag fs-3"></i>
                                </div>
                                <h3 class="h5 mb-2">Bạn chưa có đơn hàng nào</h3>
                                <p class="text-secondary fs-sm mb-4">Các đơn hàng bạn đặt sẽ được lưu trữ và theo dõi tại đây.</p>
                                <div>
                                    <a class="btn btn-primary rounded-pill" href="{{ route('frontend.sanpham') }}">Bắt đầu mua sắm</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('floating-button')
    <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" data-bs-theme="light">
        <i class="ci-sidebar fs-base me-2"></i> Quản lý tài khoản
    </button>
@endsection
