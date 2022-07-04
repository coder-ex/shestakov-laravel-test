<?php

namespace Database\Seeders;

use App\Models\TagModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // создаем 5 тегов
        TagModel::factory()->count(5)->create();
    }
}
