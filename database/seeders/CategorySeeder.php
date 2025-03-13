<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phones = [
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Google'],
            ['name' => 'OnePlus'],
            ['name' => 'Xiaomi'],
            ['name' => 'Oppo'],
            ['name' => 'Vivo'],
            ['name' => 'Realme'],
            ['name' => 'Huawei'],
            ['name' => 'Sony'],
            ['name' => 'Infinix'],
            ['name' => 'Tecno'],
        ];
        DB::table('categories')->insert($phones);
    }
}
