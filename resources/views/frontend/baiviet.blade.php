@extends('layouts.frontend')

@section('title', 'Tin tức')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
            </ol>
        </nav>

        <!-- Page title -->
        <h1 class="h3 container mb-4">Tin tức công nghệ</h1>

        <!-- Featured posts -->
        <section class="container pb-5">
            <div class="row gy-5 pb-5">
                <!-- Article featured -->
                <article class="col-md-6 col-lg-7">
                    <a class="ratio d-flex hover-effect-scale rounded-4 overflow-hidden" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'danh-gia', 'tieude_slug' => 'kham-pha-thiet-bi-cong-nghe-moi']) }}" style="--cz-aspect-ratio: calc(484 / 746 * 100%)">
                        <img src="{{ asset('public/assets/img/blog/grid/v1/01.jpg') }}" class="hover-effect-target" alt="Tin tức nổi bật" />
                    </a>
                    <div class="pt-4">
                        <div class="nav align-items-center gap-2 pb-2 mt-n1 mb-1">
                            <a class="nav-link text-body fs-xs text-uppercase p-0" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'danh-gia']) }}">Đánh giá sản phẩm</a>
                            <hr class="vr my-1 mx-1" />
                            <span class="text-body-tertiary fs-xs">26 Tháng 10, 2026</span>
                        </div>
                        <h3 class="h5 mb-0">
                            <a class="hover-effect-underline" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'danh-gia', 'tieude_slug' => 'kham-pha-thiet-bi-cong-nghe-moi']) }}">
                                Khám phá cách tối ưu hóa hiệu suất làm việc với các thiết bị công nghệ hiện đại
                            </a>
                        </h3>
                    </div>
                </article>

                <!-- Side list -->
                <div class="col-md-6 col-lg-5 d-flex flex-column align-content-between gap-4">
                    <article class="hover-effect-scale position-relative d-flex align-items-center ps-xl-4 mb-xl-1">
                        <div class="w-100 pe-3 pe-sm-4 pe-lg-3 pe-xl-4">
                            <div class="text-body-tertiary fs-xs pb-2 mb-1">20 Tháng 10, 2026</div>
                            <h3 class="h6 mb-2">
                                <a class="hover-effect-underline stretched-link" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'tin-tuc', 'tieude_slug' => 'tong-hop-san-pham-dien-tu-moi-nhat']) }}">
                                    Tổng hợp xu hướng và đánh giá các sản phẩm điện tử tiêu dùng nổi bật trong năm
                                </a>
                            </h3>
                        </div>
                        <div class="ratio w-100 rounded overflow-hidden" style="max-width: 196px; --cz-aspect-ratio: calc(140 / 196 * 100%)">
                            <img src="{{ asset('public/assets/img/blog/grid/v1/02.jpg') }}" class="hover-effect-target" alt="Image" />
                        </div>
                    </article>

                    <article class="hover-effect-scale position-relative d-flex align-items-center ps-xl-4 mb-xl-1">
                        <div class="w-100 pe-3 pe-sm-4 pe-lg-3 pe-xl-4">
                            <div class="text-body-tertiary fs-xs pb-2 mb-1">15 Tháng 10, 2026</div>
                            <h3 class="h6 mb-2">
                                <a class="hover-effect-underline stretched-link" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'cong-nghe', 'tieude_slug' => 'ket-noi-thong-minh']) }}">
                                    Công nghệ kết nối không dây thế hệ mới mang lại trải nghiệm đỉnh cao cho gia đình
                                </a>
                            </h3>
                        </div>
                        <div class="ratio w-100 rounded overflow-hidden" style="max-width: 196px; --cz-aspect-ratio: calc(140 / 196 * 100%)">
                            <img src="{{ asset('public/assets/img/blog/grid/v1/03.jpg') }}" class="hover-effect-target" alt="Image" />
                        </div>
                    </article>

                    <article class="hover-effect-scale position-relative d-flex align-items-center ps-xl-4 mb-xl-1">
                        <div class="w-100 pe-3 pe-sm-4 pe-lg-3 pe-xl-4">
                            <div class="text-body-tertiary fs-xs pb-2 mb-1">10 Tháng 10, 2026</div>
                            <h3 class="h6 mb-2">
                                <a class="hover-effect-underline stretched-link" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'iot', 'tieude_slug' => 'nha-thong-minh']) }}">
                                    Biến ngôi nhà của bạn thành không gian sống thông minh với các thiết bị IoT
                                </a>
                            </h3>
                        </div>
                        <div class="ratio w-100 rounded overflow-hidden" style="max-width: 196px; --cz-aspect-ratio: calc(140 / 196 * 100%)">
                            <img src="{{ asset('public/assets/img/blog/grid/v1/04.jpg') }}" class="hover-effect-target" alt="Image" />
                        </div>
                    </article>
                </div>
            </div>
            <hr class="my-0 my-md-2 my-lg-4" />
        </section>

        <!-- Posts grid + Sidebar -->
        <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="row">
                <!-- Posts grid -->
                <div class="col-lg-8">
                    <div class="row row-cols-1 row-cols-sm-2 gy-5">
                        <article class="col">
                            <a class="ratio d-flex hover-effect-scale rounded overflow-hidden" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'meo-hay', 'tieude_slug' => 'toi-uu-khong-gian-lam-viec']) }}" style="--cz-aspect-ratio: calc(305 / 416 * 100%)">
                                <img src="{{ asset('public/assets/img/blog/grid/v1/05.jpg') }}" class="hover-effect-target" alt="Image" />
                            </a>
                            <div class="pt-4">
                                <div class="nav align-items-center gap-2 pb-2 mt-n1 mb-1">
                                    <a class="nav-link text-body fs-xs text-uppercase p-0" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'meo-hay']) }}">Mẹo công nghệ</a>
                                    <hr class="vr my-1 mx-1" />
                                    <span class="text-body-tertiary fs-xs">5 Tháng 10, 2026</span>
                                </div>
                                <h3 class="h5 mb-0">
                                    <a class="hover-effect-underline" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'meo-hay', 'tieude_slug' => 'toi-uu-khong-gian-lam-viec']) }}">
                                        Tối ưu góc làm việc tối giản và hiệu quả cho kỹ sư công nghệ
                                    </a>
                                </h3>
                            </div>
                        </article>

                        <article class="col">
                            <a class="ratio d-flex hover-effect-scale rounded overflow-hidden" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'xu-huong', 'tieude_slug' => 'cong-nghe-camera']) }}" style="--cz-aspect-ratio: calc(305 / 416 * 100%)">
                                <img src="{{ asset('public/assets/img/blog/grid/v1/06.jpg') }}" class="hover-effect-target" alt="Image" />
                            </a>
                            <div class="pt-4">
                                <div class="nav align-items-center gap-2 pb-2 mt-n1 mb-1">
                                    <a class="nav-link text-body fs-xs text-uppercase p-0" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'xu-huong']) }}">Xu hướng</a>
                                    <hr class="vr my-1 mx-1" />
                                    <span class="text-body-tertiary fs-xs">1 Tháng 10, 2026</span>
                                </div>
                                <h3 class="h5 mb-0">
                                    <a class="hover-effect-underline" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'xu-huong', 'tieude_slug' => 'cong-nghe-camera']) }}">
                                        Khám phá công nghệ cảm biến và xử lý hình ảnh trên điện thoại thông minh
                                    </a>
                                </h3>
                            </div>
                        </article>

                        <article class="col">
                            <a class="ratio d-flex hover-effect-scale rounded overflow-hidden" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'huong-dan', 'tieude_slug' => 'chon-mua-laptop']) }}" style="--cz-aspect-ratio: calc(305 / 416 * 100%)">
                                <img src="{{ asset('public/assets/img/blog/grid/v1/07.jpg') }}" class="hover-effect-target" alt="Image" />
                            </a>
                            <div class="pt-4">
                                <div class="nav align-items-center gap-2 pb-2 mt-n1 mb-1">
                                    <a class="nav-link text-body fs-xs text-uppercase p-0" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'huong-dan']) }}">Cẩm nang mua sắm</a>
                                    <hr class="vr my-1 mx-1" />
                                    <span class="text-body-tertiary fs-xs">25 Tháng 9, 2026</span>
                                </div>
                                <h3 class="h5 mb-0">
                                    <a class="hover-effect-underline" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'huong-dan', 'tieude_slug' => 'chon-mua-laptop']) }}">
                                        Hướng dẫn chọn mua laptop phù hợp cho sinh viên và dân văn phòng
                                    </a>
                                </h3>
                            </div>
                        </article>

                        <article class="col">
                            <a class="ratio d-flex hover-effect-scale rounded overflow-hidden" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'danh-gia', 'tieude_slug' => 'tai-nghe-chong-on']) }}" style="--cz-aspect-ratio: calc(305 / 416 * 100%)">
                                <img src="{{ asset('public/assets/img/blog/grid/v1/08.jpg') }}" class="hover-effect-target" alt="Image" />
                            </a>
                            <div class="pt-4">
                                <div class="nav align-items-center gap-2 pb-2 mt-n1 mb-1">
                                    <a class="nav-link text-body fs-xs text-uppercase p-0" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'danh-gia']) }}">Đánh giá âm thanh</a>
                                    <hr class="vr my-1 mx-1" />
                                    <span class="text-body-tertiary fs-xs">18 Tháng 9, 2026</span>
                                </div>
                                <h3 class="h5 mb-0">
                                    <a class="hover-effect-underline" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => 'danh-gia', 'tieude_slug' => 'tai-nghe-chong-on']) }}">
                                        Top tai nghe chống ồn tốt nhất phân khúc đáng sở hữu trong năm
                                    </a>
                                </h3>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="col-lg-4 mt-5 mt-lg-0">
                    <div class="ps-lg-4">
                        <!-- Search widget -->
                        <div class="widget mb-4">
                            <h4 class="widget-title h6 mb-3">Tìm kiếm bài viết</h4>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Từ khóa tìm kiếm..." />
                                <button class="btn btn-primary" type="button"><i class="ci-search"></i></button>
                            </div>
                        </div>

                        <!-- Categories widget -->
                        <div class="widget mb-4">
                            <h4 class="widget-title h6 mb-3">Chủ đề</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <a class="text-body-emphasis hover-effect-underline" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'tin-tuc']) }}">Tin công nghệ</a>
                                    <span class="text-body-tertiary fs-xs">12</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <a class="text-body-emphasis hover-effect-underline" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'danh-gia']) }}">Đánh giá sản phẩm</a>
                                    <span class="text-body-tertiary fs-xs">8</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <a class="text-body-emphasis hover-effect-underline" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'meo-hay']) }}">Mẹo vặt hữu ích</a>
                                    <span class="text-body-tertiary fs-xs">15</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <a class="text-body-emphasis hover-effect-underline" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'huong-dan']) }}">Hướng dẫn mua sắm</a>
                                    <span class="text-body-tertiary fs-xs">6</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection
