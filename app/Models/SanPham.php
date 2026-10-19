<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('sanpham')]
class SanPham extends Model
{
	public function LoaiSanPham(): BelongsTo
	{
		return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id', 'id');
	}
	
	public function HangSanXuat(): BelongsTo
	{
		return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
	}
	
	public function DonHang_ChiTiet(): HasMany 
	{
		return $this->hasMany(DonHang_ChiTiet::class, 'sanpham_id', 'id');
	}
}