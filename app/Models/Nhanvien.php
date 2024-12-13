<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Model
{
    use HasFactory;
    protected $table = 'nhanviens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ma_nhan_vien',
        'ten_nhan_vien',
        'hinh_anh',
        'ngay_vao_lam',
        'luong',
        'trang_thai',
    ];
}
