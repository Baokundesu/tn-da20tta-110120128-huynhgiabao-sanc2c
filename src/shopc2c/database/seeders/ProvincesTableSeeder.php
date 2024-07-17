<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            ['name' => 'Hà Nội'],
            ['name' => 'TP. Hồ Chí Minh'],
            ['name' => 'An Giang'],
            ['name' => 'Bà Rịa-Vũng Tàu'],
            ['name' => 'Bắc Giang'],
            ['name' => 'Bắc Kạn'],
            ['name' => 'Bạc Liêu'],
            ['name' => 'Bắc Ninh'],
            ['name' => 'Bến Tre'],
            ['name' => 'Bình Định'],
            ['name' => 'Bình Dương'],
            ['name' => 'Bình Phước'],
            ['name' => 'Bình Thuận'],
            ['name' => 'Cà Mau'],
            ['name' => 'Cần Thơ'],
            ['name' => 'Cao Bằng'],
            ['name' => 'Đà Nẵng'],
            ['name' => 'Đắk Lắk'],
            ['name' => 'Đắk Nông'],
            ['name' => 'Điện Biên'],
            ['name' => 'Đồng Nai'],
            ['name' => 'Đồng Tháp'],
            ['name' => 'Gia Lai'],
            ['name' => 'Hà Giang'],
            ['name' => 'Hà Nam'],
            ['name' => 'Hà Tĩnh'],
            ['name' => 'Hải Dương'],
            ['name' => 'Hải Phòng'],
            ['name' => 'Hậu Giang'],
            ['name' => 'Hòa Bìnhh'],
            ['name' => 'Hưng Yên'],
            ['name' => 'Khánh Hòa'],
            ['name' => 'Kiên Giang'],
            ['name' => 'Kon Tum'],
            ['name' => 'Lai Châu'],
            ['name' => 'Lâm Đồng'],
            ['name' => 'Lạng Sơn'],
            ['name' => 'Lào Cai'],
            ['name' => 'Long An'],
            ['name' => 'Nam Định'],
            ['name' => 'Nghệ An'],
            ['name' => 'Ninh Bình'],
            ['name' => 'Ninh Thuận'],
            ['name' => 'Phú Thọ'],
            ['name' => 'Phú Yên'],
            ['name' => 'Quảng Bình'],
            ['name' => 'Quảng Nam'],
            ['name' => 'Quảng Ngãi'],
            ['name' => 'Quảng Ninh'],
            ['name' => 'Quảng Trị'],
            ['name' => 'Sóc Trăng'],
            ['name' => 'Sơn La'],
            ['name' => 'Tây Ninh'],
            ['name' => 'Thái Bình'],
            ['name' => 'Thái Nguyên'],
            ['name' => 'Thanh Hóa'],
            ['name' => 'Thừa Thiên - Huế'],
            ['name' => 'Tiền Giang'],
            ['name' => 'Trà Vinh'],
            ['name' => 'Tuyên Quang'],
            ['name' => 'Vĩnh Long'],
            ['name' => 'Vĩnh Phúc'],
            ['name' => 'Yên Bái'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
