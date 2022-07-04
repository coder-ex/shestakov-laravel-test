<?php

namespace Database\Seeders;

use App\Models\TypeMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


enum Types: string
{
    case Book = 'Книга';
    case Article = 'Статья';
    case Video = 'Видео';
    case Blog = 'Сайт/Блог';
    case Selection = 'Подборка';
    case KeyIdeasBook = 'Ключевые идеи книги';
}

class TypeMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 5 users using the user factory

        //$type = ['Книга', 'Статья', 'Видео', 'Сайт/Блог', 'Подборка', 'Ключевые идеи книги',]

        foreach ($res = Types::cases() as $key => $value) {
            $cat = TypeMaterial::firstOrCreate(['name' => $res[$key]->value]);
        }
    }
}

