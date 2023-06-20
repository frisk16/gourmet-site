<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            '和食',
            '洋食',
            '魚介・海鮮料理',
            'パスタ',
            'ピザ',
            '手羽先',
            'カレー',
        ];

        foreach($datas as $data) {
            Category::create([
                'name' => $data,
            ]);
        }
    }
}
