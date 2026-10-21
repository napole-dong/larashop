@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Sửa đơn hàng</div>
		<div class="card-body">
			<form action="{{ route('donhang.sua', ['id' => $donhang->id]) }}" method="post">
				@csrf
				<div class="mb-3">
					<label class="form-label" for="user_id">Khách hàng</label>
					<select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
						<option value="">-- Chọn khách hàng --</option>
						@foreach($user as $u)
							<option value="{{ $u->id }}" {{ old('user_id', $donhang->user_id) == $u->id ? 'selected' : '' }}>
								{{ $u->name }} ({{ $u->email }})
							</option>
						@endforeach
					</select>
					@error('user_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="tinhtrang_id">Tình trạng đơn hàng</label>
					<select class="form-select @error('tinhtrang_id') is-invalid @enderror" id="tinhtrang_id" name="tinhtrang_id">
						<option value="">-- Chọn tình trạng --</option>
						@foreach($tinhtrang as $tt)
							<option value="{{ $tt->id }}" {{ old('tinhtrang_id', $donhang->tinhtrang_id) == $tt->id ? 'selected' : '' }}>
								{{ $tt->tinhtrang }}
							</option>
						@endforeach
					</select>
					@error('tinhtrang_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="dienthoaigiaohang">Điện thoại giao hàng</label>
					<input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang"
						name="dienthoaigiaohang" value="{{ old('dienthoaigiaohang', $donhang->dienthoaigiaohang) }}" required />
					@error('dienthoaigiaohang')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="diachigiaohang">Địa chỉ giao hàng</label>
					<input type="text" class="form-control @error('diachigiaohang') is-invalid @enderror" id="diachigiaohang"
						name="diachigiaohang" value="{{ old('diachigiaohang', $donhang->diachigiaohang) }}" required />
					@error('diachigiaohang')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
			</form>
		</div>
	</div>
@endsection
