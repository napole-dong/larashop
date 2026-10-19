<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light bg-info shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('frontend') }}">
					<i class="fa-light fa-cart-shopping"></i> {{ config('app.name', 'Laravel') }}
				</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('loaisanpham') }}">
								<i class="fa-light fa-fw fa-diagram-project"></i> Loại sản phẩm
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('hangsanxuat') }}">
								<i class="fa-light fa-fw fa-copyright"></i> Hãng sản xuất
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('sanpham') }}">
								<i class="fa-light fa-fw fa-box"></i> Sản phẩm
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('tinhtrang') }}"> 
								<i class="fa-light fa-fw fa-list-check"></i> Tình trạng
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('donhang') }}">
								<i class="fa-light fa-fw fa-file-invoice"></i> Đơn hàng
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('nguoidung') }}">
								<i class="fa-light fa-fw fa-users"></i> Tài khoản
							</a>
						</li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
										<i class="fa-light fa-fw fa-sign-in-alt"></i> Đăng nhập
									</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
										<i class="fa-light fa-fw fa-user-plus"></i> Đăng ký
									</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa-light fa-fw fa-sign-out-alt"></i>  Đăng xuất
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
		
		<hr class="shadow-sm" />
		<footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
    </div>
	
	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
