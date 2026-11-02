@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <div class="card">
        <div class="card-header">Trang chủ</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p class="mb-0">Trang chủ quản trị.</p>
        </div>
    </div>

    @if(isset($stats))
        <div class="row g-3 mt-3">
            <div class="col-sm-6 col-xl-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Sản phẩm</h6>
                                <h2 class="mb-0">{{ $stats['sanpham'] ?? 0 }}</h2>
                            </div>
                            <i class="fa-light fa-box fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Đơn hàng</h6>
                                <h2 class="mb-0">{{ $stats['donhang'] ?? 0 }}</h2>
                            </div>
                            <i class="fa-light fa-file-invoice fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Tài khoản</h6>
                                <h2 class="mb-0">{{ $stats['nguoidung'] ?? 0 }}</h2>
                            </div>
                            <i class="fa-light fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card text-bg-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Loại sản phẩm</h6>
                                <h2 class="mb-0">{{ $stats['loaisanpham'] ?? 0 }}</h2>
                            </div>
                            <i class="fa-light fa-diagram-project fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
