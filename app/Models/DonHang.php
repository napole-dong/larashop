<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('donhang')]
class DonHang extends Model
{
    public function User(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
	
	public function TinhTrang(): BelongsTo
	{
		return $this->belongsTo(TinhTrang::class, 'tinhtrang_id', 'id');
	}
	
	public function DonHang_ChiTiet(): HasMany
	{
		return $this->hasMany(DonHang_ChiTiet::class, 'donhang_id', 'id');
	}
}