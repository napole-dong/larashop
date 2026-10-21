@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Người dùng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('nguoidung.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p>
			
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="25%">Họ và tên</th>
						<th width="25%">Email</th>
						<th width="20%">Tên đăng nhập</th>
						<th width="15%">Quyền hạn</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($nguoidung as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->email }}</td>
							<td>{{ $value->username }}</td>
							<td>
								@if($value->role == 'admin')
									<span class="badge bg-danger">Quản trị viên</span>
								@else
									<span class="badge bg-secondary">Khách hàng</span>
								@endif
							</td>
							<td class="text-center"><a href="{{ route('nguoidung.sua', ['id' => $value->id]) }}"><i class="fa-light fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('nguoidung.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa người dùng {{ $value->name }} không?')"><i class="fa-light fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
