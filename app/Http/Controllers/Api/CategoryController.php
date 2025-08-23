<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No categories found'
            ], 200);
        }
        return CategoryResource::collection($categories);
    }

    // Show single category
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
        return new CategoryResource($category);
    }

    // Create a category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'popular' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?? \Str::slug($data['name']);
        $data['uuid'] = $data['uuid'] ?? (string)\Str::uuid();
        $data['status'] = isset($data['status']) ? (int)$data['status'] : 0;
        $data['popular'] = isset($data['popular']) ? (int)$data['popular'] : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/category');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);

            $file = $request->file('image');
            $filename = time() . '_' . \Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/category/' . $filename;
        }

        $category = Category::create($data);
        return new CategoryResource($category);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'popular' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?? \Str::slug($data['name']);
        $data['status'] = isset($data['status']) ? (int)$data['status'] : $category->status;
        $data['popular'] = isset($data['popular']) ? (int)$data['popular'] : $category->popular;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/category');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);

            if ($category->image && file_exists(public_path($category->image))) {
                @unlink(public_path($category->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . \Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/category/' . $filename;
        }

        $category->update($data);

        return new CategoryResource($category);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        if ($category->image && file_exists(public_path($category->image))) {
            @unlink(public_path($category->image));
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}