                                                                                                                     Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).

                                             PHẦN 7: CÀI ĐẶT GIỎ HÀNG VÀ THANH TOÁN
Bước 1: Giới thiệu các gói “Shopping cart” cho Laravel.
Gói gloudemans/shoppingcart chỉ hỗ trợ cho Laravel 6.x trở xuống.
Liên kết: https://github.com/Crinsane/LaravelShoppingcart


Gói bumbummen99/shoppingcart là một nhánh của gloudemans/shoppingcart, hỗ trợ từ Laravel 7.x đến Laravel 9.x.
Liên kết: https://github.com/bumbummen99/LaravelShoppingcart


Gói anayarojo/shoppingcart là một nhánh của bumbummen99/shoppingcart, hỗ trợ từ Laravel 10.x đến Laravel 13.x.
Liên kết: https://packagist.org/packages/anayarojo/shoppingcart


Ngoài gói giới thiệu ở trên, có rất nhiều gói khác cũng được đánh giá tốt, các bạn có thể tìm kiếm và sử dụng thử.


Bước 2: Cài đặt gói anayarojo/shoppingcart
Tiến hành cài đặt và cấu hình theo liên kết ở Bước 1 phía trên.
Lệnh cài:
 composer require anayarojo/shoppingcart
Tạo tập tin config/cart.php:
 php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"



Các hàm thường dùng:
 STT    Tên hàm                    Mô tả                                                    Ví dụ
 1      Cart::add()                Thêm sản phẩm vào giỏ.                                   Cart::add([
                                                                                                'id' => 1,
                                                                                                'name' => 'iPhone 69 Pro Max',
                                   Lưu ý:                                                       'price' => 123000000,
                                   - 5 tham số đầu là cố định.                                  'qty' => 1,
                                   - Tham số options thứ 6 là 1 mảng tùy ý.                     'weight' => 420,
                                                                                                'options' => [
                                                                                                    'image' => 'dienthoai/iphone-69-pro-max.jpg'
                                                                                                ]
                                                                                            ]);
 2      Cart::get()              Lấy một sản phẩm trong giỏ.                               $rowId = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
                                                                                           Cart::get($rowId);
 3      Cart::update()           Cập nhật số lượng sản phẩm trong giỏ.                     $row = Cart::get($rowId);
                                                                                           if($row->qty < 10)
                                                                                           {
                                                                                               Cart::update($row_id, $row->qty + 1);
                                                                                           }
 4      Cart::remove()           Xóa một sản phẩm trong giỏ                                $rowId = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
                                                                                           Cart::remove($rowId);
 5      Cart::destroy()          Xóa toàn bộ giỏ hàng                                      Cart::destroy();
 6      Cart::count()            Đếm số lượng sản phẩm trong giỏ                           Cart::count();

 7      Cart::content()          Lấy toàn bộ giỏ hàng                                      foreach(Cart::content() as $row)
                                                                                           {
                                                                                               echo $row->rowId . '<br />';
                                                                                               echo $row->id . '<br />';
                                                                                               echo $row->name . '<br />';
                                                                                               echo $row->price . '<br />';
                                                                                               echo $row->qty . '<br />';
                                                                                               echo $row->weight . '<br />';
                                                                                           }
 8      Cart::priceTotal()       Trả về tổng giá gốc của tất cả sản phẩm.                  Cart::priceTotal();
 9      Cart::discount()         Trả về tổng giảm giá của tất cả sản phẩm.                 Cart::discount();
 10     Cart::subtotal()         Trả về tổng giá đã trừ đi giảm giá của tất cả sản phẩm.   Cart::subtotal();
 11     Cart::tax()              Trả về tổng tiền thuế của tất cả sản phẩm.                Cart::tax();
 12     Cart::total()            Trả về tổng giá phải thanh toán (cộng thêm thuế).         Cart::total();



Bước 3: Chỉnh sửa cấu hình giỏ hàng bên trong config/cart.php
Thiết lập phần trăm thuế
 'tax' => 10,


Thiết lập định dạng số lẻ thập phân, phân cách thập phân, phân cách hàng ngàn
 'format' => [
     'decimals' => 0,
     'decimal_point' => ',',
     'thousand_separator' => '.',
 ],
Bước 4: Chỉnh sửa hàm getHome bên trong tập tin app/Http/Controllers/HomeController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\LoaiSanPham;
 use Illuminate\Http\Request;

 class HomeController extends Controller
 {
     public function getHome()
     {
         $loaisanpham = LoaiSanPham::with([
                 'SanPham' => function($query) { $query->latest()->take(8); }
             ])->get();
         return view('frontend.home', compact('loaisanpham'));
     }

     ...
 }



Bước 5: Hiển thị sản phẩm ra trang chủ và cập nhật liên kết “Thêm vào giỏ hàng”
Chỉnh sửa tập tin views/frontend/home.blade.php
 @extends('layouts.frontend')

 @section('title', 'Trang chủ')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper">
         <!-- Hero slider -->
         <section class="container pt-3 mb-4">
             <div class="row">
                 <div class="col-12">
                     <div class="position-relative">
                         <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark rtl-flip" style="background:linear-gradient(90deg, #accbee 0%, #e7f0fd 100%)"></span>
                         <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark rtl-flip" style="background:linear-gradient(90deg, #1b273a 0%, #1f2632 100%)"></span>
                         <div class="row justify-content-center position-relative z-2">
                             <div class="col-xl-5 col-xxl-4 offset-xxl-1 d-flex align-items-center mt-xl-n3">
                                 <!-- Text content master slider -->
                                   <div class="swiper px-5 pe-xl-0 ps-xxl-0 me-xl-n5" data-swiper='{"spaceBetween": 64, "loop": true, "speed": 400, "controlSlider": "#sliderImages", "autoplay": {"delay": 5500, "disableOnInteraction": false}, "scrollbar": {"el": ".swiper-scrollbar"}}'>

                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                                    <p class="text-body">Cảm nhận âm thanh thực sự</p>
                                                    <h2 class="display-4 pb-2 pb-xl-4">Headphones ProMax</h2>
                                                    <a class="btn btn-lg btn-primary" href="#">
                                                        Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                                    </a>
                                                </div>
                               <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                   <p class="text-body">Ưu đãi trong tuần</p>
                                   <h2 class="display-4 pb-2 pb-xl-4">Powerful iPad Pro M2</h2>
                                   <a class="btn btn-lg btn-primary" href="#">
                                       Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                   </a>
                               </div>
                               <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                   <p class="text-body">Kính thực tế ảo</p>
                                   <h2 class="display-4 pb-2 pb-xl-4">Experience New Reality</h2>
                                   <a class="btn btn-lg btn-primary" href="#">
                                       Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-7">
                       <!-- Binded images (controlled slider) -->
                       <div class="swiper user-select-none" id="sliderImages" data-swiper='{"allowTouchMove": false, "loop": true, "effect": "fade", "fadeEffect": {"crossFade": true}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/01.png') }}" alt="Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/02.png') }}" alt="Image" />
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex justify-content-end">
                                    <div class="ratio rtl-flip" style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                        <img src="{{ asset('public/assets/img/slider/03.png') }}" alt="Image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Scrollbar -->
                <div class="row justify-content-center" data-bs-theme="dark">
                    <div class="col-xxl-10">
                        <div class="position-relative mx-5 mx-xxl-0"><div class="swiper-scrollbar mb-4"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands -->
<section class="container mb-2">
    <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false">
        <div class="row row-cols-6 g-0" style="min-width:960px">
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/apple-light-mode.svg') }}" class="d-none-dark" alt="Apple" />
                    <img src="{{ asset('public/assets/img/brands/apple-dark-mode.svg') }}" class="d-none d-block-dark" alt="Apple" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/motorola-light-mode.svg') }}" class="d-none-dark" alt="Motorola" />
                    <img src="{{ asset('public/assets/img/brands/motorola-dark-mode.svg') }}" class="d-none d-block-dark" alt="Motorola" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/xiaomi-light-mode.svg') }}" class="d-none-dark" alt="Xiaomi" />
                    <img src="{{ asset('public/assets/img/brands/xiaomi-dark-mode.svg') }}" class="d-none d-block-dark" alt="Xiaomi" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/canon-light-mode.svg') }}" class="d-none-dark" alt="Canon" />
                    <img src="{{ asset('public/assets/img/brands/canon-dark-mode.svg') }}" class="d-none d-block-dark" alt="Canon" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/samsung-light-mode.svg') }}" class="d-none-dark" alt="Samsung" />
                    <img src="{{ asset('public/assets/img/brands/samsung-dark-mode.svg') }}" class="d-none d-block-dark" alt="Samsung" />
                </a>
            </div>
            <div class="col">
                <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                    <img src="{{ asset('public/assets/img/brands/sony-light-mode.svg') }}" class="d-none-dark" alt="Sony" />
                    <img src="{{ asset('public/assets/img/brands/sony-dark-mode.svg') }}" class="d-none d-block-dark" alt="Sony" />
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Products (Grid) -->
@foreach($loaisanpham as $lsp)
    <section class="container pt-2 mt-2 mb-3">
        <!-- Heading -->
        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
            <h2 class="h3 mb-0">{{ $lsp->tenloai }}</h2>
            <div class="nav ms-3">
               <a class="nav-link animate-underline px-0 py-2" href="{{ route('frontend.sanpham.phanloai', ['tenloai_slug' => $lsp->tenloai_slug]) }}">
                   <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
               </a>
           </div>
       </div>

       <!-- Product grid -->
       <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">
           <!-- Item -->
           @foreach($lsp->SanPham as $sp)
<div class="col">
    <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
        <div class="position-relative">
            <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
                <div class="d-flex flex-column gap-2">
                    <button type="button" class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex">
                        <i class="ci-heart fs-base animate-target"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-secondary animate-rotate d-none d-lg-inline-flex">
                        <i class="ci-refresh-cw fs-base animate-target"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown d-lg-none position-absolute top-0 end-0 z-2 mt-2 me-2">
                <button type="button" class="btn btn-icon btn-sm btn-secondary bg-body" data-bs-toggle="dropdown">
                    <i class="ci-more-vertical fs-lg"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end fs-xs p-2" style="min-width:auto">
                    <li>
                        <a class="dropdown-item" href="#"><i class="ci-heart fs-sm ms-n1 me-2"></i> Thêm vào yêu thích</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"><i class="ci-refresh-cw fs-sm ms-n1 me-2"></i> So sánh</a>
                    </li>
                </ul>
            </div>
           <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
               <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                   <img src="{{ asset('storage/app/private/' . $sp->hinhanh) }}" />
               </div>
               <span class="badge bg-info position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3">Mới</span>
           </a>
       </div>
       <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
           <div class="d-flex align-items-center gap-2 mb-2">
               <div class="d-flex gap-1 fs-xs">
                   <i class="ci-star-filled text-warning"></i>
                   <i class="ci-star-filled text-warning"></i>
                   <i class="ci-star-filled text-warning"></i>
                   <i class="ci-star-filled text-warning"></i>
                   <i class="ci-star text-body-tertiary opacity-75"></i>
               </div>
               <span class="text-body-tertiary fs-xs">(123)</span>
           </div>
           <h3 class="pb-1 mb-2">
                 <a class="d-block fs-sm fw-medium text-truncate" href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                    <span class="animate-target">{{ $sp->tensanpham }}</span>
               </a>
           </h3>
           <div class="d-flex align-items-center justify-content-between">
               <div class="h5 lh-1 mb-0">{{ number_format($sp->dongia, 0, ',', '.') }}<small>đ</small></div>
                 <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2">
                       <i class="ci-shopping-cart fs-base animate-target"></i>
               </a>
           </div>
       </div>
   </div>
                         </div>
                     @endforeach
                 </div>
             </section>
         @endforeach
     </main>
 @endsection



Kết quả hiển thị trang chủ:
Bước 6: Cài đặt giỏ hàng bên trong app/Http/Controllers/HomeController.php
<?php

namespace App\Http\Controllers;

use App\Models\LoaiSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    ...

    public function getGioHang()
    {
        if(Cart::count() > 0)
            return view('frontend.giohang');
        else
            return view('frontend.giohangrong');
    }

    public function getGioHang_Them($tensanpham_slug = '')
    {
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();

        Cart::add([
            'id' => $sanpham->id,
            'name' => $sanpham->tensanpham,
            'price' => $sanpham->dongia,
            'qty' => 1,
            'weight' => 0,
            'options' => [
                'image' => $sanpham->hinhanh
            ]
        ]);

        return redirect()->route('frontend.home');
    }

    public function getGioHang_Xoa($row_id)
    {
        Cart::remove($row_id);

        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Giam($row_id)
     {
           $row = Cart::get($row_id);

           // Nếu số lượng là 1 thì không giảm được nữa
           if($row->qty > 1)
           {
               Cart::update($row_id, $row->qty - 1);
           }

           return redirect()->route('frontend.giohang');
     }

     public function getGioHang_Tang($row_id)
     {
         $row = Cart::get($row_id);

           // Không được tăng vượt quá 10 sản phẩm
           if($row->qty < 10)
           {
               Cart::update($row_id, $row->qty + 1);
           }

           return redirect()->route('frontend.giohang');
     }

     ...
 }



Bước 7: Chỉnh sửa các view liên quan đến giỏ hàng
 Chỉnh sửa tập tin views/layouts/frontend.blade.php
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-pwa="true">
 <head>
     ...
 </head>

 <body>
     <!-- Search offcanvas -->
     ...

     <!-- Shopping cart offcanvas -->
     <div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="shoppingCart" tabindex="-1" style="width:500px">
         <!-- Header -->
         <div class="offcanvas-header flex-column align-items-start py-3 pt-lg-4">
             <div class="d-flex align-items-center justify-content-between w-100">
                 <h4 class="offcanvas-title" id="shoppingCartLabel">Giỏ hàng ({{ Cart::count() ?? 0 }})</h4>
                 <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
             </div>
        </div>

        @if(Cart::count() > 0)
            <!-- Items -->
            <div class="offcanvas-body d-flex flex-column gap-4 pt-2">
                <!-- Item -->
                @foreach(Cart::content() as $value)
                    <div class="d-flex align-items-center">
                        <a class="flex-sm-shrink-0" href="#" style="width:142px">
                            <div class="ratio bg-body-tertiary rounded overflow-hidden" style="--cz-aspect-ratio:calc(110 / 142 * 100%)">
                                <img src="{{ asset('storage/app/private/' . $value->options->image ) }}" alt="Thumbnail" />
                            </div>
                        </a>
                        <div class="w-100 min-w-0 ps-3">
                            <h5 class="d-flex animate-underline mb-2">
                                <a class="d-block fs-sm fw-medium text-truncate animate-target" href="#">{{ $value->name }}</a>
                            </h5>
                            <div class="d-flex align-items-center justify-content-between gap-1">
                                <div class="h6 mt-1 mb-0">{{ number_format($value->price, 0, ',', '.') }}<small>đ</small></div>
                               <a href="{{ route('frontend.giohang.xoa', ['row_id' => $value->rowId]) }}" class="btn btn-icon btn-sm flex-shrink-0 fs-sm" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-sm" data-bs-title="Xóa khỏi giỏ">
                                    <i class="ci-trash fs-base"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer -->
            <div class="offcanvas-header flex-column align-items-start">
                <div class="d-flex align-items-center justify-content-between w-100 mb-3 mb-md-4">
                    <span class="text-light-emphasis">Tổng tiền:</span>
                    <span class="h6 mb-0">{{ Cart::priceTotal() }}<small>đ</small></span>
                </div>
                <a class="btn btn-lg btn-dark w-100 rounded-pill" href="{{ route('frontend.giohang') }}">Giỏ hàng</a>
            </div>
        @else
            <div class="offcanvas-body text-center">
                <svg class="d-block mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="60" viewBox="0 0 29.5 30"><path class="text-body-tertiary"
d="M17.8 4c.4 0 .8-.3.8-.8v-2c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8v2c0 .4.3.8.8.8zm3.2.6c.4.2.8 0 1-.4l.4-.9c.2-.4 0-.8-.4-1s-.8 0-1 .4l-.4.9c-.2.4 0 .9.4 1zm-
7.5-.4c.2.4.6.6 1 .4s.6-.6.4-1l-.4-.9c-.2-.4-.6-.6-1-.4s-.6.6-.4 1l.4.9z" fill="currentColor"/><path class="text-body-emphasis" d="M10.7 24.5c-1.5 0-2.8
1.2-2.8 2.8S9.2 30 10.7 30s2.8-1.2 2.8-2.8-1.2-2.7-2.8-2.7zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.5 1.2-1.2 1.2zm11.1-4c-1.5 0-2.8 1.2-2.8
2.8a2.73 2.73 0 0 0 2.8 2.8 2.73 2.73 0 0 0 2.8-2.8c0-1.6-1.3-2.8-2.8-2.8zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.6 1.2-1.2 1.2zM8.7
18h16c.3 0 .6-.2.7-.5l4-10c.2-.5-.2-1-.7-1H9.3c-.4 0-.8.3-.8.8s.4.7.8.7h18.3l-3.4 8.5H9.3L5.5 1C5.4.7 5.1.5 4.8.5h-4c-.5 0-.8.3-.8.7s.3.8.8.8h3.4l3.7
14.6a3.24 3.24 0 0 0-2.3 3.1C5.5 21.5 7 23 8.7 23h16c.4 0 .8-.3.8-.8s-.3-.8-.8-.8h-16a1.79 1.79 0 0 1-1.8-1.8c0-1 .9-1.6 1.8-1.6z"
fill="currentColor"/></svg>
                <h6 class="mb-2">Giỏ hàng của bạn hiện đang trống!</h6>
                <p class="fs-sm mb-4">Khám phá nhiều mặt hàng của chúng tôi và thêm sản phẩm vào giỏ hàng.</p>
                <a class="btn btn-dark rounded-pill" href="{{ route('frontend.home') }}">Tiếp tục mua sắm</a>
            </div>
        @endif
    </div>

   <!-- Navigation bar (Page header) -->
   <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element>
       <div class="container flex-nowrap">
              ...

              <!-- Button group -->
              <div class="d-flex align-items-center">
                    ...

                    <!-- Cart button -->
                    <button type="button" class="btn btn-icon btn-lg fs-xl btn-outline-secondary position-relative border-0 rounded-circle animate-scale" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                          <span class="position-absolute top-0 start-100 badge fs-xs text-bg-primary rounded-pill mt-1 ms-n4 z-2" style="--cz-badge-padding-y:.25em; --cz-badge-padding-x:.42em">{{ Cart::count() ?? 0 }}</span>
                    <i class="ci-shopping-bag animate-target me-1"></i>
                </button>
            </div>
        </div>
    </header>

    ...
 </body>
 </html>



 Tạo mới và chỉnh sửa tập tin views/frontend/giohang.blade.php
 @extends('layouts.frontend')

 @section('title', 'Giỏ hàng')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper">
         <nav class="container pt-3 my-3">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                 <li class="breadcrumb-item"><a href="{{ route('frontend.sanpham') }}">Sản phẩm</a></li>
                 <li class="breadcrumb-item active">Giỏ hàng</li>
             </ol>
         </nav>

           <section class="container mb-3">
               <h1 class="h3 mb-2">Giỏ hàng</h1>
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
                                                                <button type="button" class="nav-link d-inline-block text-decoration-underline text-nowrap py-3 px-0">Xóa</button>
                                                       </div>
                                                   </th>
       </tr>
   </thead>
   <tbody class="align-middle">
       <!-- Item -->
       @foreach(Cart::content() as $value)
           <tr>
               <td class="py-3 ps-0">
                   <div class="d-flex align-items-center">
                       <a class="flex-shrink-0" href="#">
                                   <img src="{{ asset('storage/app/private/' . $value->options->image ) }}" width="110" alt="{{ $value->name }}" />
                           </a>
                           <div class="w-100 min-w-0 ps-2 ps-xl-3">
                               <h5 class="d-flex animate-underline mb-2">
                                   <a class="d-block fs-sm fw-medium text-truncate animate-target" href="#">{{ $value->name }}</a>
                               </h5>
                               <ul class="list-unstyled gap-1 fs-xs mb-0">
                                   <li class="d-xl-none">
                                       <span class="text-body-secondary">Đơn giá:</span>
                                                   <span class="text-dark-emphasis fw-medium">{{ number_format($value->price, 0, ',', '.') }}<small>đ</small></span>
                                       </li>
                                   </ul>
                                   <div class="count-input rounded-2 d-md-none mt-3">
                                           <a href="{{ route('frontend.giohang.giam', ['row_id' => $value->rowId]) }}" class="btn btn-sm btn-icon" data-decrement>
                                               <i class="ci-minus"></i>
                                           </a>
                                           <input type="number" class="form-control form-control-sm" id="qty" name="qty" min="1" value="{{ $value->qty }}" readonly />
                                           <a href="{{ route('frontend.giohang.tang', ['row_id' => $value->rowId]) }}" class="btn btn-sm btn-icon" data-increment>
                                   <i class="ci-plus"></i>
                               </a>
                           </div>
                       </div>
                   </div>
               </td>
               <td class="h6 py-3 d-none d-xl-table-cell">{{ number_format($value->price, 0, ',', '.') }}<small>đ</small></td>
               <td class="py-3 d-none d-md-table-cell">
                   <div class="count-input">
                           <a href="{{ route('frontend.giohang.giam', ['row_id' => $value->rowId]) }}" class="btn btn-icon" data-decrement>
                               <i class="ci-minus"></i>
                           </a>
                           <input type="number" class="form-control" id="qty" name="qty" min="1" value="{{ $value->qty }}" readonly />
                           <a href="{{ route('frontend.giohang.tang', ['row_id' => $value->rowId]) }}" class="btn btn-icon" data-increment>
                           <i class="ci-plus"></i>
                       </a>
                   </div>
               </td>
               <td class="h6 py-3 d-none d-md-table-cell">{{ number_format($value->price * $value->qty, 0, ',', '.') }}<small>đ</small></td>
               <td class="text-end py-3 px-0">
                    <a href="{{ route('frontend.giohang.xoa', ['row_id' => $value->rowId]) }}" class="btn-close fs-sm" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-sm" data-bs-title="Xóa khỏi giỏ"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="nav position-relative z-2 mb-4 mb-lg-0">
    <a class="nav-link animate-underline px-0" href="{{ route('frontend.home') }}">
        <i class="ci-chevron-left fs-lg me-1"></i>
        <span class="animate-target">Tiếp tục mua hàng</span>
    </a>
                         </div>
                     </div>
                 </div>

                 <!-- Order summary (sticky sidebar) -->
                 <aside class="col-lg-4" style="margin-top:-100px">
                     <div class="position-sticky top-0" style="padding-top:100px">
                         <div class="bg-body-tertiary rounded-5 p-4 mb-3">
                             <div class="p-sm-2 p-lg-0 p-xl-2">
                                 <h5 class="border-bottom pb-4 mb-4">Tóm tắt đơn hàng</h5>
                                 <ul class="list-unstyled fs-sm gap-3 mb-0">
                                     <li class="d-flex justify-content-between">
                                         Tổng tiền ({{ Cart::count() ?? 0 }} sản phẩm):
                                         <span class="text-dark-emphasis fw-medium">{{ Cart::priceTotal() }}<small>đ</small></span>
                                     </li>
                                     <li class="d-flex justify-content-between">
                                         Giảm giá:
                                         <span class="text-danger fw-medium">{{ Cart::discount() }}<small>đ</small></span>
                                     </li>
                                     <li class="d-flex justify-content-between">
                                         Thuế VAT:
                                         <span class="text-dark-emphasis fw-medium">{{ Cart::tax() }}<small>đ</small></span>
                                     </li>
                                     <li class="d-flex justify-content-between">
                                         Phí vận chuyển:
                                         <span class="text-dark-emphasis fw-medium">Tính toán khi thanh toán</span>
                                     </li>
                                 </ul>
                                 <div class="border-top pt-4 mt-4">
                                     <div class="d-flex justify-content-between mb-3">
                                         <span class="fs-sm">Tổng ước tính:</span>
                                         <span class="h5 mb-0">{{ Cart::total() }}<small>đ</small></span>
                                     </div>
                                     <a class="btn btn-lg btn-primary w-100" href="{{ route('user.dathang') }}">
                                         Tiến hành thanh toán
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



 Tạo mới và chỉnh sửa tập tin views/frontend/giohangrong.blade.php
 @extends('layouts.frontend')

 @section('title', 'Giỏ hàng rỗng')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper d-flex align-items-center justify-content-center">
          <div class="container">
              <section class="text-center py-4 px-2 px-sm-0 my-2 my-md-3 my-lg-4 my-xl-5 mx-auto" style="max-width:636px">
                  <div class="pb-4 mb-3 mx-auto" style="max-width:524px">
                      <svg class="d-block mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 29.5 30"><path class="text-body-tertiary"
 d="M17.8 4c.4 0 .8-.3.8-.8v-2c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8v2c0 .4.3.8.8.8zm3.2.6c.4.2.8 0 1-.4l.4-.9c.2-.4 0-.8-.4-1s-.8 0-1 .4l-.4.9c-.2.4 0 .9.4 1zm-
 7.5-.4c.2.4.6.6 1 .4s.6-.6.4-1l-.4-.9c-.2-.4-.6-.6-1-.4s-.6.6-.4 1l.4.9z" fill="currentColor" /><path class="text-body-emphasis" d="M10.7 24.5c-1.5 0-2.8
 1.2-2.8 2.8S9.2 30 10.7 30s2.8-1.2 2.8-2.8-1.2-2.7-2.8-2.7zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.5 1.2-1.2 1.2zm11.1-4c-1.5 0-2.8 1.2-2.8
 2.8a2.73 2.73 0 0 0 2.8 2.8 2.73 2.73 0 0 0 2.8-2.8c0-1.6-1.3-2.8-2.8-2.8zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.6 1.2-1.2 1.2zM8.7
 18h16c.3 0 .6-.2.7-.5l4-10c.2-.5-.2-1-.7-1H9.3c-.4 0-.8.3-.8.8s.4.7.8.7h18.3l-3.4 8.5H9.3L5.5 1C5.4.7 5.1.5 4.8.5h-4c-.5 0-.8.3-.8.7s.3.8.8.8h3.4l3.7
 14.6a3.24 3.24 0 0 0-2.3 3.1C5.5 21.5 7 23 8.7 23h16c.4 0 .8-.3.8-.8s-.3-.8-.8-.8h-16a1.79 1.79 0 0 1-1.8-1.8c0-1 .9-1.6 1.8-1.6z" fill="currentColor"
 /></svg>
                  </div>
                  <h5 class="mb-2">Giỏ hàng của bạn hiện đang trống!</h5>
                  <p class="fs-sm mb-4">Khám phá nhiều mặt hàng của chúng tôi và thêm sản phẩm vào giỏ hàng.</p>
                  <a class="btn btn-dark rounded-pill" href="{{ route('frontend.home') }}">Tiếp tục mua sắm</a>
              </section>
          </div>
     </main>
 @endsection



Bước 8: Xử lý đặt hàng
 Cài đặt các hàm thanh toán bên trong app/Http/Controllers/KhachHangController.php
 <?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use App\Models\DonHang;
 use App\Models\DonHang_ChiTiet;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Hash;
 use Gloudemans\Shoppingcart\Facades\Cart;

 class KhachHangController extends Controller
 {
     ...

     public function getDatHang()
     {
         if(Auth::check())
             return view('user.dathang');
         else
             return redirect()->route('user.dangnhap');
     }
     public function postDatHang(Request $request)
     {
         // Kiểm tra
         $this->validate($request, [
             'diachigiaohang' => ['required', 'string', 'max:255'],
             'dienthoaigiaohang' => ['required', 'string', 'max:255'],
         ]);

           // Lưu vào đơn hàng
           $dh = new DonHang();
           $dh->user_id = Auth::user()->id;
           $dh->tinhtrang_id = 1; // Đơn hàng mới
           $dh->diachigiaohang = $request->diachigiaohang;
           $dh->dienthoaigiaohang = $request->dienthoaigiaohang;
           $dh->save();

           // Lưu vào đơn hàng chi tiết
           foreach(Cart::content() as $value)
           {
               $ct = new DonHang_ChiTiet();
               $ct->donhang_id = $dh->id;
               $ct->sanpham_id = $value->id;
               $ct->soluongban = $value->qty;
               $ct->dongiaban = $value->price;
               $ct->save();
           }

           return redirect()->route('user.dathangthanhcong');
     }

     public function getDatHangThanhCong()
     {
         // Xóa giỏ hàng khi hoàn tất đặt hàng?
         Cart::destroy();

           return view('user.dathangthanhcong');
     }

     ...
 }


 Tạo mới và chỉnh sửa tập tin views/user/dathang.blade.php
 @extends('layouts.frontend')

 @section('title', 'Thanh toán đơn hàng')

 @section('content')
     <!-- Page content -->
<main class="content-wrapper">
    <nav class="container pt-3 my-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.giohang') }}">Giỏ hàng</a></li>
            <li class="breadcrumb-item active">Thanh toán đơn hàng</li>
        </ol>
    </nav>

    <div class="container mb-3">
        <div class="row pt-1 pt-sm-3 pt-lg-4 pb-2">
            <div class="col-lg-8 col-xl-7 position-relative z-2 mb-4 mb-lg-0">
                <div class="d-flex align-items-start">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-sm fw-semibold lh-1 flex-shrink-0" style="width:2rem; height:2rem; margin-top:-.125rem">1</div>
                    <div class="w-100 ps-3 ps-md-4">
                        <h1 class="h5 mb-md-4">Thông tin giao hàng</h1>
                        <form action="{{ route('user.dathang') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="dienthoaigiaohang" class="form-label">Điện thoại giao hàng <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-lg @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang" name="dienthoaigiaohang" required />
                                </div>
                                <div class="mb-3">
                                    <label for="diachigiaohang" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-lg @error('diachigiaohang') is-invalid @enderror" id="diachigiaohang" name="diachigiaohang" required />
                            </div>
                            <input type="submit" id="checkout-form-submit" name="checkout-form-submit" hidden />
                        </form>
                    </div>
                </div>

                <div class="d-flex align-items-start pt-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-sm fw-semibold lh-1 flex-shrink-0" style="width:2rem; height:2rem; margin-top:-.125rem">2</div>
                    <div class="w-100 ps-3 ps-md-4">
                        <h2 class="h5 mb-0">Thông tin thanh toán</h2>
                        <div class="mb-4" id="paymentMethod" role="list">
                            <!-- Cash on delivery -->
                            <div class="mt-4">
                                <div class="form-check mb-0" role="listitem">
                                    <label class="form-check-label w-100 text-dark-emphasis fw-semibold">
                                        <input type="radio" class="form-check-input fs-base me-2 me-sm-3" name="payment-method" value="cod" checked />
                                        Thanh toán khi nhận hàng
                                    </label>
                                </div>
                            </div>
                            <!-- Credit card -->
                            <div class="mt-4">
                                <div class="form-check mb-0" role="listitem">
                                    <label class="form-check-label d-flex align-items-center text-dark-emphasis fw-semibold">
                                        <input type="radio" class="form-check-input fs-base me-2 me-sm-3" name="payment-method" value="creditcard" />
                                        Thẻ tín dụng hoặc thẻ ghi nợ
                                        <span class="d-none d-sm-flex gap-2 ms-3">
                                                          <img src="{{ asset('public/assets/img/payment-methods/amex.svg') }}" class="d-block bg-info rounded-1" width="36" alt="Amex" />
                                                          <img src="{{ asset('public/assets/img/payment-methods/visa-light-mode.svg') }}" class="d-none-dark" width="36" alt="Visa" />
                                     <img src="{{ asset('public/assets/img/payment-methods/visa-dark-mode.svg') }}" class="d-none d-block-dark" width="36" alt="Visa" />
                                  <img src="{{ asset('public/assets/img/payment-methods/mastercard.svg') }}" width="36" alt="Mastercard" />
                                  <img src="{{ asset('public/assets/img/payment-methods/maestro.svg') }}" width="36" alt="Maestro" />
                             </span>
                         </label>
                     </div>
                 </div>
                 <!-- PayPal -->
                 <div class="mt-4">
                     <div class="form-check mb-0" role="listitem">
                         <label class="form-check-label d-flex align-items-center text-dark-emphasis fw-semibold">
                             <input type="radio" class="form-check-input fs-base me-2 me-sm-3" name="payment-method" value="paypal" />
                             PayPal
                                <img src="{{ asset('public/assets/img/payment-methods/paypal-icon.svg') }}" class="ms-3" width="16" alt="PayPal" />
                         </label>
                     </div>
                 </div>
                 <!-- Google Pay -->
                 <div class="mt-4">
                     <div class="form-check mb-0" role="listitem">
                         <label class="form-check-label d-flex align-items-center text-dark-emphasis fw-semibold">
                             <input type="radio" class="form-check-input fs-base me-2 me-sm-3" name="payment-method" value="googlepay" />
                             Google Pay
                                <img src="{{ asset('public/assets/img/payment-methods/google-icon.svg') }}" class="ms-3" width="20" alt="Google Pay" />
                       </label>
                   </div>
               </div>
           </div>

           <div class="form-check mb-lg-4">
               <input type="checkbox" class="form-check-input" id="accept-terms" name="accept-terms" checked>
               <label for="accept-terms" class="form-check-label nav align-items-center">
                   Tôi đồng ý với các
                   <a class="nav-link text-decoration-underline fw-normal ms-1 p-0" href="#">Điều khoản và Điều kiện</a>
               </label>
           </div>

           <!-- Pay button visible on screens > 991px wide (lg breakpoint) -->
           <label for="checkout-form-submit" class="btn btn-lg btn-primary w-100 d-none d-lg-flex">Thanh toán {{ Cart::total() ?? 0 }}<small>đ</small></label>
        </div>
    </div>
</div>

<aside class="col-lg-4 offset-xl-1" style="margin-top:-100px">
    <div class="position-sticky top-0" style="padding-top:100px">
        <div class="bg-body-tertiary rounded-5 p-4 mb-3">
            <div class="p-sm-2 p-lg-0 p-xl-2">
                <div class="border-bottom pb-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="mb-0">Tóm tắt đơn hàng</h5>
                    </div>
                    <a class="d-flex align-items-center gap-2 text-decoration-none" href="#orderPreview" data-bs-toggle="offcanvas">
                        @foreach(Cart::content() as $value)
                            <div class="ratio ratio-1x1" style="max-width:64px">
                                     <img src="{{ asset('storage/app/private/' . $value->options->image ) }}" class="d-block p-1" alt="{{ $value->name }}" />
                              </div>
                          @endforeach
                                <i class="ci-chevron-right text-body fs-xl p-0 ms-auto"></i>
                            </a>
                        </div>
                        <ul class="list-unstyled fs-sm gap-3 mb-0">
                            <li class="d-flex justify-content-between">
                                Tổng tiền ({{ Cart::count() ?? 0 }} sản phẩm):
                                <span class="text-dark-emphasis fw-medium">{{ Cart::priceTotal() }}<small>đ</small></span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Giảm giá:
                                <span class="text-danger fw-medium">{{ Cart::discount() }}<small>đ</small></span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Thuế VAT:
                                <span class="text-dark-emphasis fw-medium">{{ Cart::tax() }}<small>đ</small></span>
                            </li>
                            <li class="d-flex justify-content-between">
                                Phí vận chuyển:
                                <span class="text-dark-emphasis fw-medium">0<small>đ</small></span>
                            </li>
                        </ul>
                        <div class="border-top pt-4 mt-4">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fs-sm">Tổng ước tính:</span>
                                <span class="h5 mb-0">{{ Cart::total() }}<small>đ</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- Order preview offcanvas -->
<div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="orderPreview" tabindex="-1" style="width:500px">
    <div class="offcanvas-header py-3 pt-lg-4">
        <h4 class="offcanvas-title" id="orderPreviewLabel">Đơn hàng của bạn</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column gap-3 py-2">
        <!-- Item -->
        @foreach(Cart::content() as $value)
            <div class="d-flex align-items-center">
                <a class="flex-shrink-0" href="#">
                    <img src="{{ asset('storage/app/private/' . $value->options->image ) }}" width="110" alt="{{ $value->name }}" />
                </a>
                <div class="w-100 min-w-0 ps-2 ps-sm-3">
                    <h5 class="d-flex animate-underline mb-2">
                        <a class="d-block fs-sm fw-medium text-truncate animate-target" href="#">{{ $value->name }}</a>
                    </h5>
                    <div class="h6 mb-0">{{ number_format($value->price, 0, ',', '.') }}<small>đ</small></div>
                    <div class="fs-xs pt-2">Số lượng: {{ $value->qty }}</div>
                </div>
            </div>
        @endforeach
             </div>
             <div class="offcanvas-header">
                 <a class="btn btn-lg btn-outline-secondary w-100" href="{{ route('frontend.giohang') }}">Chỉnh sửa giỏ hàng</a>
             </div>
         </div>
     </main>
 @endsection

 @section('floating-button')
     <!-- Fixed positioned pay button that is visible on screens < 992px wide (lg breakpoint) -->
     <div class="fixed-bottom z-sticky w-100 py-2 px-3 bg-body border-top shadow d-lg-none">
         <label for="checkout-form-submit" class="btn btn-lg btn-primary w-100">Thanh toán {{ Cart::total() ?? 0 }}<small>đ</small></label>
     </div>
 @endsection



 Chỉnh sửa tập tin views/user/dathangthanhcong.blade.php
 @extends('layouts.frontend')

 @section('title', 'Hoàn tất đặt hàng')

 @section('content')
     <!-- Page content -->
     <main class="content-wrapper">
         <section class="container mt-4 mb-4">
             <div class="position-relative overflow-hidden rounded-5 p-4 p-sm-5" style="background-color:var(--cz-success-border-subtle)">
                 <div class="position-relative z-2 text-center py-4 py-md-5 my-md-2 my-lg-5 mx-auto" style="max-width:536px">
                     <h1 class="pt-xl-4 mb-4">Cảm ơn bạn đã đặt hàng!</h1>
                     <p class="text-dark-emphasis pb-3 pb-sm-4">Đơn hàng đã được chấp nhận và sẽ được xử lý sớm nhất có thể.</p>
                     <a class="btn btn-lg btn-dark rounded-pill mb-xl-4" href="{{ route('frontend.home') }}">Tiếp tục mua sắm</a>
                 </div>
                 <img src="{{ asset('public/assets/img/checkout/thankyou-bg-1.png') }}" class="animate-up-down position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Background image" />
                 <img src="{{ asset('public/assets/img/checkout/thankyou-bg-2.png') }}" class="animate-down-up position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Background image" />
             </div>
         </section>
     </main>
 @endsection
