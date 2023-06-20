<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            if($i <= 5) {
                Store::create([
                    'category_id' => 2,
                    'name' => "洋食店{$i}号",
                    'commission' => 100 * $i,
                    'description' => 'これはテスト用ページです。',
                ]);
            } elseif($i > 5 && $i <= 10) {
                $num = $i - 5;
                Store::create([
                    'category_id' => 4,
                    'name' => "パスタ店{$num}号",
                    'commission' => 50 * $i,
                    'description' => 'これはテスト用ページです。',
                ]);
            } elseif($i > 10 && $i <= 15) {
                $num = $i - 10;
                Store::create([
                    'category_id' => 5,
                    'name' => "ピザ店{$num}号",
                    'commission' => 10 * $i,
                    'description' => 'これはテスト用ページです。',
                ]);
            } else {
                $num = $i - 15;
                Store::create([
                    'category_id' => 7,
                    'name' => "カレー店{$num}号",
                    'commission' => 10 * $i,
                    'description' => 'これはテスト用ページです。',
                ]);
            }
        }
    }
}
