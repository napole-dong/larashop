@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Loại sản phẩm</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('hangsanxuat.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
			</p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Hình ảnh</th>
						<th width="45%">Tên hãng sản xuất</th>
						<th width="30%">Tên hãng sản xuất không dấu</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hangsanxuat as $value)
						<tr>
							<td class="align-middle">{{ $loop->iteration }}</td>
							<td class="align-middle text-center">
								<img src="{{ asset('storage/app/private/' . $value->hinhanh) }}" width="100"
									class="img-thumbnail" />
							</td>
							<td class="align-middle">{{ $value->tenhang }}</td>
							<td class="align-middle">{{ $value->tenhang_slug }}</td>
							<td class="align-middle text-center">
								<a href="{{ route('hangsanxuat.sua', ['id' => $value->id]) }}">
									<i class="fa-light fa-edit"></i>
								</a>
							</td>
							<td class="align-middle text-center">
								<a href="{{ route('hangsanxuat.xoa', ['id' => $value->id]) }}"
									onclick="return confirm('Bạn có muốn xóa hãng sản xuất {{ $value->tenhang }} không?')">
									<i class="fa-light fa-trash-alt text-danger"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection