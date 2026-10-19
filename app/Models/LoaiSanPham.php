<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('loaisanpham')]
class LoaiSanPham extends Model
{
	public function SanPham(): HasMany
	{
		return $this->hasMany(SanPham::class, 'loaisanpham_id', 'id');
	}
}