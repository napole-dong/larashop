@extends('layouts.frontend')

@section('title', 'Chi tiết bài viết')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.baiviet') }}">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
            </ol>
        </nav>

        <!-- Post content + Sidebar -->
        <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="row">
                <!-- Posts content -->
                <div class="col-lg-8 position-relative z-2">
                    <!-- Post title -->
                    <h1 class="h3 mb-4">Thanh toán thông minh và kỷ nguyên công nghệ số trong thương mại điện tử</h1>

                    <!-- Post meta -->
                    <div class="nav align-items-center gap-2 border-bottom pb-4 mt-n1 mb-4">
                        <a class="nav-link text-body fs-xs text-uppercase p-0" href="#">Công nghệ mới</a>
                        <hr class="vr my-1 mx-1" />
                        <span class="text-body-tertiary fs-xs">26 Tháng 10, 2026</span>
                    </div>

                    <p class="fs-lg text-secondary">
                        Sự phát triển vượt bậc của công nghệ số đang định hình lại toàn bộ trải nghiệm mua sắm trực tuyến, mang lại giải pháp thanh toán nhanh chóng, tiện lợi và an toàn tối đa cho người dùng.
                    </p>

                    <figure class="figure w-100 py-3 py-md-4 mb-3">
                        <div class="ratio" style="--cz-aspect-ratio: calc(599 / 856 * 100%)">
                            <img src="{{ asset('public/assets/img/blog/post/main.jpg') }}" class="rounded-4" alt="Hình ảnh bài viết" />
                        </div>
                        <figcaption class="figure-caption fs-sm pt-2">Xu hướng công nghệ thanh toán tương lai</figcaption>
                    </figure>

                    <p>
                        Một trong những bước tiến đáng chú ý nhất chính là việc tích hợp các ví điện tử, thanh toán chạm và xác thực sinh trắc học trực tiếp trên các nền tảng thương mại điện tử. Người dùng có thể hoàn tất việc mua sắm chỉ trong vài giây mà không cần nhập lại thông tin thẻ phức tạp.
                    </p>

                    <h2 class="h5 pt-3 pt-md-4 mb-md-4">Ứng dụng trí tuệ nhân tạo (AI) trong chăm sóc khách hàng</h2>
                    <p>
                        Các hệ thống chatbot và trợ lý ảo thông minh ngày nay có khả năng phân tích sở thích, đề xuất sản phẩm chính xác theo nhu cầu cá nhân và giải đáp thắc mắc của người tiêu dùng 24/7.
                    </p>

                    <ul class="py-2">
                        <li>Cá nhân hóa trải nghiệm duyệt danh mục sản phẩm theo sở thích.</li>
                        <li>Tối ưu hóa quy trình kiểm tra và đóng gói đơn hàng tự động.</li>
                        <li>Bảo mật đa lớp giúp ngăn chặn gian lận giao dịch hiệu quả.</li>
                    </ul>

                    <p>
                        Tất cả những cải tiến này đang góp phần xây dựng một hệ sinh thái bán hàng hiện đại, thân thiện và đáng tin cậy.
                    </p>

                    <!-- Tags and Share -->
                    <div class="d-sm-flex align-items-center justify-content-between border-top border-bottom py-4 my-4">
                        <div class="d-flex flex-wrap gap-2 mb-3 mb-sm-0">
                            <span class="text-body-tertiary fs-sm me-1">Từ khóa:</span>
                            <a class="btn btn-xs btn-outline-secondary rounded-pill" href="#">Công nghệ</a>
                            <a class="btn btn-xs btn-outline-secondary rounded-pill" href="#">Thanh toán</a>
                            <a class="btn btn-xs btn-outline-secondary rounded-pill" href="#">AI</a>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-body-tertiary fs-sm">Chia sẻ:</span>
                            <a class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" href="#"><i class="ci-facebook"></i></a>
                            <a class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" href="#"><i class="ci-twitter"></i></a>
                            <a class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" href="#"><i class="ci-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="col-lg-4 mt-5 mt-lg-0">
                    <div class="ps-lg-4">
                        <div class="widget mb-4">
                            <h4 class="widget-title h6 mb-3">Bài viết liên quan</h4>
                            <div class="d-flex flex-column gap-3">
                                <article class="d-flex align-items-center gap-3">
                                    <div class="ratio rounded overflow-hidden flex-shrink-0" style="width: 80px; --cz-aspect-ratio: 100%">
                                        <img src="{{ asset('public/assets/img/blog/grid/v1/02.jpg') }}" alt="Related" />
                                    </div>
                                    <div>
                                        <span class="text-body-tertiary fs-xs">20 Tháng 10, 2026</span>
                                        <h6 class="fs-sm mb-0">
                                            <a class="hover-effect-underline" href="#">Tổng hợp sản phẩm điện tử tiêu dùng nổi bật</a>
                                        </h6>
                                    </div>
                                </article>
                                <article class="d-flex align-items-center gap-3">
                                    <div class="ratio rounded overflow-hidden flex-shrink-0" style="width: 80px; --cz-aspect-ratio: 100%">
                                        <img src="{{ asset('public/assets/img/blog/grid/v1/03.jpg') }}" alt="Related" />
                                    </div>
                                    <div>
                                        <span class="text-body-tertiary fs-xs">15 Tháng 10, 2026</span>
                                        <h6 class="fs-sm mb-0">
                                            <a class="hover-effect-underline" href="#">Kết nối không dây thế hệ mới</a>
                                        </h6>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection
