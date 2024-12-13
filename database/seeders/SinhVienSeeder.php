<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++){
            DB::table('sinh_viens')->insert([
                'ma_sinh_vien' => "SV$i",
                'ten_sinh_vien' => "Sinh viên $i",
                'hinh_anh' => "https://khoinguonsangtao.vn/wp-content/uploads/2022/08/anh-que-huong-mien-tay-yen-binh.jpg",
                'ngay_sinh' => date('Y-m-d'),
                'so_dien_thoai' => "0123456789",
                'trang_thai' => true
            ]);
        }
    }
}
