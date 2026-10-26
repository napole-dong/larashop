@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Sản phẩm</div>
		<div class="card-body table-responsive">
			<p>
				<a href="{{ route('sanpham.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fa-light fa-upload"></i> Nhập từ Excel</a>
				<a href="{{ route('sanpham.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất ra Excel</a>
			</p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Loại sản phẩm</th>
						<th width="10%">HSX</th>
						<th width="35%">Tên sản phẩm</th>
						<th width="5%">SL</th>
						<th width="10%">Đơn giá</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sanpham as $value)
						<tr>
							<td class="align-middle">{{ $loop->iteration }}</td>
							<td class="align-middle text-center">
								<img src="{{ asset('storage/app/private/' . $value->hinhanh) }}" width="80"
									class="img-thumbnail" />    
							</td>
							<td class="align-middle">{{ $value->LoaiSanPham->tenloai }}</td>
							<td class="align-middle">{{ $value->HangSanXuat->tenhang }}</td>
							<td class="align-middle">{{ $value->tensanpham }}</td>
							<td class="align-middle text-end">{{ $value->soluong }}</td>
							<td class="align-middle text-end">{{ number_format($value->dongia) }}</td>
							<td class="align-middle text-center">
								<a href="{{ route('sanpham.sua', ['id' => $value->id]) }}">
									<i class="fa-light fa-edit"></i>
								</a>
							</td>
							<td class="align-middle text-center">
								<a href="{{ route('sanpham.xoa', ['id' => $value->id]) }}"
									onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')">
									<i class="fa-light fa-trash-alt text-danger"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<form action="{{ route('sanpham.nhap') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-0">
							<label for="file_excel" class="form-label">Chọn tập tin Excel</label>
							<input type="file" class="form-control @error('file_excel') is-invalid @enderror" id="file_excel" name="file_excel" required />
							@error('file_excel')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-light fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fa-light fa-upload"></i> Nhập dữ liệu</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('javascript')
	@error('file_excel')
		<script>
			const importModal = new bootstrap.Modal(document.getElementById('importModal'));
			importModal.show();
		</script>
	@enderror
@endsection