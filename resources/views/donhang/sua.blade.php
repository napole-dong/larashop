@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Sửa san pham</div>
		<div class="card-body">
			<form action="{{ route('donhang.sua', ['id' => $sanpham->id]) }}" method="post">
				@csrf
				<div class="mb-3">
					<label class="form-label" for="tenhang">Tên loại</label>
					<input type="text" class="form-control" id="tenhang" name="tenhang" value="{{ $donhang->tenhang }}" required />
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
			</form>
		</div>
	</div>
@endsection