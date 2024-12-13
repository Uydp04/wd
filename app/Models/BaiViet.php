<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    protected $table = 'bai_viets';

    protected $fillable = ['hinh_anh', 'tieu_de', 'noi_dung', 'ngay_dang', 'trang_thai'];

    public $timestamps = false;
}