<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\TagService;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagService;

    public function __construct()
    {
        $this->tagService = new TagService();
    }

    public function getAll()
    {
        try {
            $result = $this->tagService->getAll();

            return response()->json([
                'success' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function edit(Request $req, $id)
    {
        try {
            $this->validate($req, [
                'name' => 'required|min:3|max:50',
            ]);

            $data = [
                $id,
                $req['name'],
            ];

            //---
            return response()->json($this->tagService->editTag(...$data), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function create(Request $req)
    {
        try {
            $this->validate($req, [
                'name' => 'required|min:3|max:50',
            ]);

            $data = [
                $req['name']
            ];
            
            //---
            return response()->json($this->tagService->createTag(...$data), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }
}
