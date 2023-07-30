<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 登録するレコードの準備
        $categories = [
            [ 'title' => 'programing' ],
            [ 'title' => 'design' ],
            [ 'title' => 'management' ],
        ];
    }
}
