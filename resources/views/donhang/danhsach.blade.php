@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Đơn hàng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('donhang.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
			
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="20%">Khách hàng</th>
						<th width="15%">Điện thoại</th>
						<th width="35%">Địa chỉ giao hàng</th>
						<th width="15%">Tình trạng</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($donhang as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->User->name ?? 'N/A' }}</td>
							<td>{{ $value->dienthoaigiaohang }}</td>
							<td>{{ $value->diachigiaohang }}</td>
							<td><span class="badge bg-info">{{ $value->TinhTrang->tinhtrang ?? 'N/A' }}</span></td>
							<td class="text-center"><a href="{{ route('donhang.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('donhang.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa đơn hàng #{{ $value->id }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
