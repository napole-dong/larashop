@extends('layouts.frontend')

@section('title', 'Giỏ hàng trống')

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

        <!-- Empty cart message -->
        <section class="container text-center py-5 my-2 my-md-4 my-lg-5">
            <div class="d-inline-flex bg-body-tertiary text-primary rounded-circle p-4 mb-4" style="width: 100px; height: 100px; align-items: center; justify-content: center">
                <i class="ci-shopping-cart" style="font-size: 3rem"></i>
            </div>
            <h1 class="h2 mb-3">Giỏ hàng của bạn đang trống</h1>
            <p class="text-secondary fs-lg mb-4 pb-2">Hãy khám phá thêm hàng trăm sản phẩm công nghệ tuyệt vời trên cửa hàng của chúng tôi!</p>
            <a class="btn btn-lg btn-primary rounded-pill px-5" href="{{ route('frontend.sanpham') }}">
                <i class="ci-arrow-left me-2"></i> Khám phá sản phẩm
            </a>
        </section>
    </main>
@endsection
