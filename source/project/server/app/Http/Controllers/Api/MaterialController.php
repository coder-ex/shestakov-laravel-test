<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\MaterialService;
use Illuminate\Http\Request;
use Exception;

class MaterialController extends Controller
{
    private $materialService;

    public function __construct()
    {
        $this->materialService = new MaterialService();
    }

    public function getAll()
    {
        try {
            $result = $this->materialService->getAll();

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
                'type' => 'required|min:3|max:50',
                'category' => 'required|min:3|max:50',
                'title' => 'required|min:3|max:100',
                'author' => 'nullable|email:rfc',
                'description' => 'nullable|min:3',
            ]);
            
            $data = [
                $id,
                $req['type'],
                $req['category'],
                $req['title'],
                $req['author'],
                $req['description'],
            ];

            return response()->json($this->materialService->editMaterial(...$data), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function create(Request $req)
    {
        try {
            $this->validate($req, [
                'type' => 'required|min:3|max:50',
                'category' => 'required|min:3|max:50',
                'title' => 'required|min:3|max:100',
                'author' => 'nullable|email:rfc',
                'description' => 'nullable|min:3',
            ]);

            $data = [
                $req['type'],
                $req['category'],
                $req['title'],
                $req['author'],
                $req['description'],
            ];

            return response()->json($this->materialService->createMaterial(...$data), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function get(Request $req, string $id) {
        try {
            return response()->json($this->materialService->getMaterial($id), 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }
}
