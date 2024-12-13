<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanvienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++){
            DB::table('nhanviens')->insert([
                'ma_nhan_vien' => "NV$i",
                'ten_nhan_vien' => "Nhan viên $i",
                'hinh_anh' => "https://khoinguonsangtao.vn/wp-content/uploads/2022/08/anh-que-huong-mien-tay-yen-binh.jpg",
                'ngay_vao_lam' => date('Y-m-d'),
                'luong' => "100002$i",
                'trang_thai' => true
            ]);
        }
    }
}
