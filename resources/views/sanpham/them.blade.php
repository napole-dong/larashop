@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Thêm sản phẩm</div>
		<div class="card-body">
			<form action="{{ route('sanpham.them') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="mb-3">
					<label class="form-label" for="loaisanpham_id">Loại sản phẩm</label>
					<select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="loaisanpham_id" name="loaisanpham_id">
						<option value="">-- Chọn loại sản phẩm --</option>
						@foreach($loaisanpham as $loai)
							<option value="{{ $loai->id }}" {{ old('loaisanpham_id') == $loai->id ? 'selected' : '' }}>
								{{ $loai->tenloai }}
							</option>
						@endforeach
					</select>
					@error('loaisanpham_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="hangsanxuat_id">Hãng sản xuất</label>
					<select class="form-select @error('hangsanxuat_id') is-invalid @enderror" id="hangsanxuat_id" name="hangsanxuat_id">
						<option value="">-- Chọn hãng sản xuất --</option>
						@foreach($hangsanxuat as $hang)
							<option value="{{ $hang->id }}" {{ old('hangsanxuat_id') == $hang->id ? 'selected' : '' }}>
								{{ $hang->tenhang }}
							</option>
						@endforeach
					</select>
					@error('hangsanxuat_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="tensanpham">Tên sản phẩm</label>
					<input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham"
						name="tensanpham" value="{{ old('tensanpham') }}" />
					@error('tensanpham')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="soluong">Số lượng</label>
					<input type="number" class="form-control @error('soluong') is-invalid @enderror" id="soluong"
						name="soluong" value="{{ old('soluong') }}" />
					@error('soluong')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="dongia">Đơn giá</label>
					<input type="number" class="form-control @error('dongia') is-invalid @enderror" id="dongia"
						name="dongia" value="{{ old('dongia') }}" />
					@error('dongia')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
					<input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh"
						name="hinhanh" />
					@error('hinhanh')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="motasanpham">Mô tả sản phẩm</label>
					<textarea class="form-control @error('motasanpham') is-invalid @enderror" id="motasanpham"
						name="motasanpham" rows="4">{{ old('motasanpham') }}</textarea>
					@error('motasanpham')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
			</form>
		</div>
	</div>
@endsection
