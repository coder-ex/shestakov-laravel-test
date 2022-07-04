<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Material;
use App\Models\TypeMaterial;
use App\Models\User;
use Exception;

class MaterialService
{
    public function getAll()
    {
        $materials = Material::all();
        $result = [];
        foreach ($materials as $key => $value) {
            //$value->user;

            $result[] = [
                'id' => $value->id,
                'title' => $value->title,
                'author' => ['id' => $value->user->id, 'name' => $value->user->name,],
                'type' => $value->type->name,
                'category' => $value->category->name,
            ];
        }

        //---
        return $result;
    }

    public function editMaterial(string $id, string $type, string $category, string $title, string $email = null, string $description = null)
    {
        $material = Material::where('id', $id)->first();
        if (is_null($material)) {
            throw new Exception('Материал для редактирования не найден.');
        }

        $t = TypeMaterial::where('name', $type)->first();
        if (!is_null($t)) {
            $material->type_id = $t->id;
        }

        $t = Category::where('name', $category)->first();
        if (!is_null($t)) {
            $material->category_id = $t->id;
        }

        if (!is_null($email)) {
            $t = User::where('email', $email)->first();
            if (is_null($t)) {
                $t = new User();
                $t->name = explode(' ', fake('ru_RU')->name(), PHP_INT_MAX)[0];
                $t->email = $email;
                $t->password = app('hash')->make('12345'); // password
                $t->save();
            }
            $material->user_id = $t->id;
        }

        $material->title = $title ? $title : $material->title;
        $material->description = $description ? $description : $material->description;
        $material->save();
        //---
        return $material;
    }

    public function createMaterial(string $type, string $category, string $title, string $email = null, string $description = null)
    {
        $material = new Material();

        $t = TypeMaterial::where('name', $type)->first();
        if (is_null($t)) {
            throw new Exception('Тип материала не соответствует заданным типам.');
        }
        $material->type_id = $t->id;

        $t = Category::where('name', $category)->first();
        if (is_null($t)) {
            $t = new Category();
            $t->name = $category;
            $t->save();
        }
        $material->category_id = $t->id;

        if (!is_null($email)) {
            $t = User::where('email', $email)->first();
            if (is_null($t)) {
                $t = new User();
                $t->name = explode(' ', fake('ru_RU')->name(), PHP_INT_MAX)[0];
                $t->email = $email;
                $t->password = app('hash')->make('12345'); // password
                $t->save();
            }
            $material->user_id = $t->id;
        }

        $material->title = $title;
        $material->description = $description;
        $material->save();
        //---
        return $material;
    }

    public function getMaterial(string $id)
    {
        $material = Material::where('id', $id)->first();
        if (is_null($material))
            throw new Exception('Не корректный ID ' . $id);

        //---
        return [
            'title' => $material->title,
            'author' => ['name' => $material->user->name, 'email' => $material->user->email],
            'type' => $material->type->name,
            'category' => $material->category->name,
            'description' => $material->description,
            'tags' => [$material->tag],
            'urls' => [$material->url]
        ];
    }
}
