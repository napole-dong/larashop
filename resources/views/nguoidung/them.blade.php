@extends('layouts.app')

@section('content')
	<div class="card"> 
		<div class="card-header">Thêm người dùng</div>
		<div class="card-body">
			<form action="{{ route('nguoidung.them') }}" method="post">
				@csrf
				<div class="mb-3">
					<label class="form-label" for="name">Họ và tên</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
						name="name" value="{{ old('name') }}" required />
					@error('name')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="email">Địa chỉ Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
						name="email" value="{{ old('email') }}" required />
					@error('email')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="username">Tên đăng nhập</label>
					<input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
						name="username" value="{{ old('username') }}" />
					@error('username')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="role">Quyền hạn</label>
					<select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
						<option value="">-- Chọn quyền hạn --</option>
						<option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Khách hàng</option>
						<option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
					</select>
					@error('role')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="password">Mật khẩu</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
						name="password" required />
					@error('password')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
					<input type="password" class="form-control" id="password_confirmation"
						name="password_confirmation" required />
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
			</form>
		</div>
	</div>
@endsection
