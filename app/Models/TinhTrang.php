<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('tinhtrang')]
class TinhTrang extends Model
{
    public function DonHang(): HasMany
	{
		return $this->hasMany(DonHang::class, 'tinhtrang_id', 'id');
	}
}