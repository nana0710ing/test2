<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => '腕時計',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'brand_name' => 'Rolex',
            'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'category_id' => 1,
            'condition_id' => 1,
        ]);

        Item::create([
    'name' => 'HDD',
    'description' => '高速で信頼性の高いハードディスク',
    'price' => 5000,
    'brand_name' => '西芝',
    'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
    'category_id' => 2,
    'condition_id' => 2,
]);

        Item::create([
    'name' => '玉ねぎ3束',
    'description' => '新鮮な玉ねぎ3束のセット',
    'price' => 300,
    'brand_name' => null,
    'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
    'category_id' => 10,
    'condition_id' => 3,
]);

       Item::create([
        'name' => '革靴',
        'description' => 'クラッシックなデザインの革靴',
        'price' =>4000,
        'brand_name' => null,
        'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
        'category_id' => 1,
        'condition_id' => 4,
]);

         Item::create([
            'name' => 'ノートPC',
             'description' => '高性能なノートパソコン',
             'price' =>45000,
             'brand_name' => null,
             'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
             'category_id' => 2,
             'condition_id' => 1,
         ]);

         Item::create([
            'name' => 'マイク',
            'description' => '高音質のレコーディング用マイク',
            'price' =>8000,
            'brand_name' => null,
            'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'category_id' => 2,
            'condition_id' => 2,
            ]);

         Item::create([
            'name' => 'ショルダーバッグ',
            'description' => 'おしゃれなショルダーバッグ',
            'price' =>3500,
            'brand_name' => null,
            'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'category_id' => 1,
            'condition_id' => 3,
            ]);

            Item::create([
    'name' => 'タンブラー',
    'description' => '使いやすいタンブラー',
    'price' => 500,
    'brand_name' => null,
    'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
    'category_id' => 10,
    'condition_id' => 4,
]);

        Item::create([
    'name' => 'コーヒーミル',
    'description' => '手動のコーヒーミル',
    'price' => 4000,
    'brand_name' => 'Starbucks',
    'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
    'category_id' => 10,
    'condition_id' => 1,
]);

        Item::create([
    'name' => 'メイクセット',
    'description' => '便利なメイクアップセット',
    'price' => 2500,
    'brand_name' => null,
    'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
    'category_id' => 6,
    'condition_id' => 2,
]);
    }
}
