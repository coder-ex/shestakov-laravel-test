<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function getAll()
    {
        try {
            $result = $this->categoryService->getAll();

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
            return response()->json($this->categoryService->editCategory(...$data), 200);
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
            return response()->json($this->categoryService->createCategory(...$data), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }
}
