<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Material;
use App\Models\TagModel;
use App\Models\TypeMaterial;
use App\Models\UrlModel;
use App\Models\User;
use DeepCopy\TypeMatcher\TypeMatcher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(TypeMaterialsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagModelSeeder::class);
        $this->call(UrlModelSeeder::class);

        $url = 'https://jsonplaceholder.typicode.com/posts';
        $news = json_decode(file_get_contents($url), true, JSON_UNESCAPED_UNICODE);
        $users = User::all();

        $types = TypeMaterial::all();
        $cnt_t = $types->count();                       // число типов материала
        $categories = Category::all();
        $cnt_c = $categories->count();                  // число категорий
        $tags = TagModel::all();
        $cnt_tm = $tags->count();                       // число тегов
        $urls = UrlModel::all();
        $cnt_um = $urls->count();                       // число урлов

        $step = intdiv(count($news), count($users));    // размер шага
        $remain = count($news) % count($users);         // остаток
        $count_u = count($users);                       // число user
        $offset = 0;                                    // смещение
        foreach ($users as $key => $value) {
            if ($remain > 0 && $key == $count_u - 1) $step += $remain;

            for ($i = $offset; $i < $step + $offset; $i++) {
                if ($cnt_t == 0) $cnt_t = $types->count();
                if ($cnt_c == 0) $cnt_c = $categories->count();
                if ($cnt_tm == 0) $cnt_tm = $tags->count();
                if ($cnt_um == 0) $cnt_um = $urls->count();

                $this->create(
                    $urls[--$cnt_um],
                    $tags[--$cnt_tm],
                    $categories[--$cnt_c],
                    $types[--$cnt_t],
                    $value,
                    $news[$i]
                );
            }

            $offset += $step;
        }


        Model::reguard();
    }

    public function create(UrlModel $url, TagModel $tag, Category $category, TypeMaterial $type, User $user, array $data)
    {
        DB::transaction(function () use ($url, $tag, $category, $type, $user, $data) {
            $material = Material::create([
                'title' => $data['title'],
                'description' => $data['body'],
                'user_id' => $user->id,
                'type_id' => $type->id,
                'category_id' => $category->id,
                'tag_id' => $tag->id,
                'url_id' => $url->id,
            ]);

            if (!$material) {
                throw new \Exception('News not created for account');
            }
        });
    }
}
