@extends('layouts.frontend')

@section('title', 'Liên hệ')

@section('content')
    <main class="content-wrapper">
        <!-- Page title -->
        <section class="position-relative bg-body-tertiary py-4">
            <div class="container position-relative z-2 py-4 py-md-5 my-lg-3 my-xl-4">
                <div class="row pt-lg-2 pb-2 pb-sm-3 pb-lg-4">
                    <div class="col-9 col-md-8 col-lg-6">
                        <h1 class="display-4 mb-lg-4">Liên hệ chúng tôi</h1>
                        <p class="mb-0">Đội ngũ hỗ trợ của {{ config('app.name', 'Laravel') }} luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact details -->
        <section class="container pt-5 mt-2 mt-sm-3 mt-lg-4 mt-xl-5 mb-n3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 pt-lg-2 pt-xl-0">
                <!-- Location -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="ci-map-pin fs-lg text-dark-emphasis"></i>
                        <h3 class="h6 ps-2 ms-1 mb-0">Địa chỉ cửa hàng</h3>
                    </div>
                    <hr class="text-dark-emphasis opacity-50 my-3 my-md-4" />
                    <ul class="list-unstyled">
                        <li>Số 18 Ung Văn Khiêm, P. Đông Xuyên</li>
                        <li>TP. Long Xuyên, Tỉnh An Giang</li>
                    </ul>
                </div>

                <!-- Phones -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="ci-phone-outgoing fs-lg text-dark-emphasis"></i>
                        <h3 class="h6 ps-2 ms-1 mb-0">Điện thoại hỗ trợ</h3>
                    </div>
                    <hr class="text-dark-emphasis opacity-50 my-3 my-md-4" />
                    <ul class="list-unstyled">
                        <li>Tư vấn bán hàng: 1900 1234</li>
                        <li>Hỗ trợ kỹ thuật: 1900 5678</li>
                    </ul>
                </div>

                <!-- Emails -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="ci-mail fs-lg text-dark-emphasis"></i>
                        <h3 class="h6 ps-2 ms-1 mb-0">Hộp thư điện tử</h3>
                    </div>
                    <hr class="text-dark-emphasis opacity-50 my-3 my-md-4" />
                    <ul class="list-unstyled">
                        <li>Khách hàng: hotro@larashop.vn</li>
                        <li>Hợp tác: lienhe@larashop.vn</li>
                    </ul>
                </div>

                <!-- Working hours -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="ci-clock fs-lg text-dark-emphasis"></i>
                        <h3 class="h6 ps-2 ms-1 mb-0">Giờ mở cửa</h3>
                    </div>
                    <hr class="text-dark-emphasis opacity-50 my-3 my-md-4" />
                    <ul class="list-unstyled">
                        <li>Thứ Hai - Thứ Bảy: 8:00 - 21:00</li>
                        <li>Chủ Nhật: 8:30 - 18:00</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Contact Form & Support -->
        <section class="container py-5 my-2 my-sm-3 my-lg-4 my-xl-5">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <h2 class="h3 mb-3">Gửi tin nhắn cho chúng tôi</h2>
                    <p class="text-secondary mb-4">Điền thông tin vào mẫu bên dưới, chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc.</p>
                    
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" placeholder="Nguyễn Văn A" required />
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label">Địa chỉ email</label>
                                <input type="email" class="form-control" id="email" placeholder="email@domain.com" required />
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Chủ đề</label>
                                <input type="text" class="form-control" id="subject" placeholder="Tiêu đề yêu cầu" required />
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Nội dung</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Viết nội dung tin nhắn của bạn..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-lg btn-primary">Gửi liên hệ</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-5 offset-lg-1">
                    <div class="card bg-body-tertiary border-0 rounded-4 p-4 p-sm-5 h-100 d-flex flex-column justify-content-center">
                        <h3 class="h4 mb-3">Bạn cần hỗ trợ nhanh?</h3>
                        <p class="text-secondary mb-4">Hãy xem qua danh mục các câu hỏi thường gặp của chúng tôi để tìm câu trả lời ngay lập tức.</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px">
                                    <i class="ci-delivery fs-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Chính sách vận chuyển</h6>
                                    <span class="fs-xs text-body-tertiary">Giao hàng toàn quốc từ 2-4 ngày</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px">
                                    <i class="ci-refresh-cw fs-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Đổi trả trong 30 ngày</h6>
                                    <span class="fs-xs text-body-tertiary">Miễn phí đổi mới nếu lỗi từ nhà sản xuất</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px">
                                    <i class="ci-shield-check fs-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Bảo hành chính hãng</h6>
                                    <span class="fs-xs text-body-tertiary">Cam kết 100% hàng chính hãng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
