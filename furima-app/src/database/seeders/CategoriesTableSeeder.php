<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'ファッション',
        ]);

        Category::create([
            'name' => '家電',
        ]);

        Category::create([
            'name' => 'インテリア',
        ]);

        Category::create([
            'name' => 'レディース',
        ]);

        Category::create([
            'name' => 'メンズ',
        ]);

        Category::create([
            'name' => 'コスメ',
        ]);

        Category::create([
            'name' => '本',
        ]);

        Category::create([
            'name' => 'ゲーム',
        ]);

        Category::create([
            'name' => 'スポーツ',
        ]);

        Category::create([
            'name' => 'キッチン',
        ]);

        Category::create([
            'name' => 'ハンドメイド',
        ]);

        Category::create([
            'name' => 'アクセサリー',
        ]);

        Category::create([
            'name' => 'おもちゃ',
        ]);

        Category::create([
            'name' => 'ベビー・キッズ',
        ]);
    }
}
