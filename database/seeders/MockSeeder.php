<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class MockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Category::query()->create([
            'title' => 'Диваны',
        ])->id;

        Item::query()->create([
            'title' => 'Диван раскладной',
            'price' => 70000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Диван кухонный',
            'price' => 40000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Диван для гостиной',
            'price' => 50000,
            'category_id' => $id,
        ]);


        $id = Category::query()->create([
            'title' => 'Шкафы',
        ])->id;

        Item::query()->create([
            'title' => 'Шкаф одно-створчатый',
            'price' => 20000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Шкаф двух-створчатый',
            'price' => 30000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Шкаф трех-створчатый',
            'price' => 40000,
            'category_id' => $id,
        ]);


        $id = Category::query()->create([
            'title' => 'Кресла',
        ])->id;

        Item::query()->create([
            'title' => 'Кресло гостевое',
            'price' => 20000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Кресло кожаное',
            'price' => 40000,
            'category_id' => $id,
        ]);

        Item::query()->create([
            'title' => 'Кресло реклайнер',
            'price' => 70000,
            'category_id' => $id,
        ]);
    }
}
