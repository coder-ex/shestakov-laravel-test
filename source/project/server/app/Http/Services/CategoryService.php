<?php

namespace App\Http\Services;

use App\Models\Category;
use Exception;

class CategoryService
{
    public function getAll()
    {
        $category = Category::all();
        $result = [];
        foreach ($category as $key => $value) {
            $result[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }

        //---
        return $result;
    }

    public function editCategory(string $id, string $name)
    {
        $category = Category::where('id', $id)->first();
        if (is_null($category)) {
            throw new Exception('Категория [ID: ' . $id . '] для редактирования не найдена.');
        }

        $category->name = $name ? $name : $category->name;
        $category->save();
        //---
        return $category;
    }

    public function createCategory(string $name)
    {
        $category = Category::where('name', $name)->first();
        if (!is_null($category)) {
            throw new Exception('Категория [ID: ' . $category->id . '] существует.');
        }
        
        $category = new Category();
        $category->name = $name;
        $category->save();
        //---
        return $category;
    }
}
