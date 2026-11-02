@extends('layouts.frontend')

@section('title', 'Tuyển dụng')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tuyển dụng</li>
            </ol>
        </nav>

        <!-- Content + Sidebar -->
        <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 position-relative z-2">
                    <h1 class="h3 mb-4">Cơ hội nghề nghiệp tại {{ config('app.name', 'Laravel') }}</h1>

                    <div class="nav align-items-center gap-2 border-bottom pb-4 mt-n1 mb-4">
                        <span class="badge bg-success-subtle text-success">Đang tuyển dụng</span>
                        <hr class="vr my-1 mx-1" />
                        <span class="text-body-tertiary fs-xs">Cập nhật: 26 Tháng 10, 2026</span>
                    </div>

                    <p class="fs-lg text-secondary">
                        Chúng tôi luôn chào đón những ứng viên tài năng, nhiệt huyết và đam mê công nghệ cùng gia nhập đội ngũ phát triển sản phẩm của {{ config('app.name', 'Laravel') }}.
                    </p>

                    <figure class="figure w-100 py-3 py-md-4 mb-3">
                        <div class="ratio" style="--cz-aspect-ratio: calc(599 / 856 * 100%)">
                            <img src="{{ asset('public/assets/img/blog/post/main.jpg') }}" class="rounded-4" alt="Tuyển dụng" />
                        </div>
                    </figure>

                    <h2 class="h5 pt-3 pt-md-4 mb-md-4">Vị trí: Lập trình viên Full-stack (PHP / Laravel / Vue.js)</h2>
                    <ul class="py-2">
                        <li><strong>Số lượng:</strong> 02 nhân sự</li>
                        <li><strong>Địa điểm làm việc:</strong> TP. Long Xuyên, An Giang (hoặc Hybrid)</li>
                        <li><strong>Mức lương:</strong> Thỏa thuận cạnh tranh theo năng lực (12.000.000₫ - 25.000.000₫)</li>
                        <li><strong>Kinh nghiệm:</strong> Tối thiểu 1 năm làm việc với Laravel framework</li>
                    </ul>

                    <h2 class="h5 pt-3 pt-md-4 mb-md-3">Mô tả công việc</h2>
                    <p>
                        Tham gia thiết kế, phát triển và tối ưu hóa hệ thống thương mại điện tử, các API dịch vụ và tích hợp cổng thanh toán trực tuyến. Phối hợp cùng đội ngũ UI/UX để hoàn thiện giao diện người dùng theo chuẩn responsive và hiện đại.
                    </p>

                    <h2 class="h5 pt-3 pt-md-4 mb-md-3">Yêu cầu ứng viên</h2>
                    <ul class="py-2">
                        <li>Thành thạo PHP 8+, Laravel 10+, MySQL, Eloquent ORM.</li>
                        <li>Kinh nghiệm xây dựng RESTful APIs, tích hợp dịch vụ bên thứ ba.</li>
                        <li>Nắm vững HTML5, CSS3/SASS, Bootstrap 5, JavaScript/TypeScript.</li>
                        <li>Khả năng làm việc độc lập và phối hợp nhóm hiệu quả.</li>
                    </ul>

                    <h2 class="h5 pt-3 pt-md-4 mb-md-3">Quyền lợi được hưởng</h2>
                    <ul class="py-2">
                        <li>Đầy đủ chế độ bảo hiểm theo quy định pháp luật.</li>
                        <li>Thưởng lương tháng 13, thưởng hiệu quả dự án và các kỳ nghỉ lễ.</li>
                        <li>Được trang bị máy móc, thiết bị làm việc hiện đại.</li>
                    </ul>

                    <div class="card bg-body-tertiary border-0 rounded-4 p-4 mt-4">
                        <h3 class="h6 mb-2">Cách thức ứng tuyển</h3>
                        <p class="fs-sm mb-3">Vui lòng gửi CV của bạn về địa chỉ email của chúng tôi với tiêu đề <code>[Ứng tuyển] Họ tên - Vị trí</code>:</p>
                        <a href="mailto:tuyendung@larashop.vn" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i class="ci-mail"></i> Gửi hồ sơ ứng tuyển
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="col-lg-4 mt-5 mt-lg-0">
                    <div class="ps-lg-4">
                        <div class="widget mb-4">
                            <h4 class="widget-title h6 mb-3">Vị trí khác</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom">
                                    <h6 class="fs-sm mb-1"><a class="hover-effect-underline" href="#">Chuyên viên tư vấn bán hàng</a></h6>
                                    <span class="text-body-tertiary fs-xs">TP. Long Xuyên • Toàn thời gian</span>
                                </li>
                                <li class="py-2 border-bottom">
                                    <h6 class="fs-sm mb-1"><a class="hover-effect-underline" href="#">Kỹ thuật viên phần cứng & điện thoại</a></h6>
                                    <span class="text-body-tertiary fs-xs">TP. Long Xuyên • Toàn thời gian</span>
                                </li>
                                <li class="py-2 border-bottom">
                                    <h6 class="fs-sm mb-1"><a class="hover-effect-underline" href="#">Nhân viên Digital Marketing</a></h6>
                                    <span class="text-body-tertiary fs-xs">TP. Long Xuyên • Toàn thời gian</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection
