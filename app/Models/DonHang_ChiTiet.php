<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('donhang_chitiet')]
class DonHang_ChiTiet extends Model
{
    public function DonHang(): BelongsTo
	{
		return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
	}
	
	public function SanPham(): BelongsTo
	{
		return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
	}
}