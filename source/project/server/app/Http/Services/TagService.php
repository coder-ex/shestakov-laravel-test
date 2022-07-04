<?php

namespace App\Http\Services;

use App\Models\TagModel;
use Exception;

class TagService
{
    public function getAll() {
        $tags = TagModel::all();
        $result = [];
        foreach ($tags as $key => $value) {
            //$value->user;

            $result[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }

        //---
        return $result;
    }

    public function editTag(string $id, string $name)
    {
        $tag = TagModel::where('id', $id)->first();
        if (is_null($tag)) {
            throw new Exception('Тег [ID: '.$id.'] для редактирования не найден.');
        }

        $tag->name = $name ? $name : $tag->name;
        $tag->save();
        //---
        return $tag;
    }

    public function createTag(string $name)
    {
        $tag = TagModel::where('name', $name)->first();
        if (!is_null($tag)) {
            throw new Exception('Тег [ID: ' . $tag->id . '] существует.');
        }

        $tag = new TagModel();
        $tag->name = $name;
        $tag->save();
        //---
        return $tag;
    }
}
