<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('san_phams')->insert([
                'ma_san_pham' => 'SP' . $faker->unique()->numberBetween(1000, 9999),
                'ten_san_pham' => $faker->word(),
                'mo_ta' => $faker->sentence(),
                'gia' => $faker->numberBetween(100000, 1000000),
                'gia_khuyen_mai' => $faker->numberBetween(100000, 1000000),
                'so_luong' => $faker->numberBetween(10, 100),
                'trang_thai' => $faker->boolean(),
                'hinh_anh' => null,
                'ngay_nhap' => $faker->date(),
            ]);
        }
    }
}
