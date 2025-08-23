<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommended;
use App\Http\Resources\RecommendedResource;
use Illuminate\Support\Str;

class RecommendedController extends Controller
{
    // Get all recommended items
    public function index()
    {
        $recommended = Recommended::with(['category', 'product'])->get();

        if ($recommended->isEmpty()) {
            return response()->json([
                'message' => 'There are no recommended products yet.'
            ], 200);
        }

        return RecommendedResource::collection($recommended);
    }

    // Get a single recommended item
    public function show($id)
    {
        $item = Recommended::with(['category', 'product'])->find($id);
        if (!$item) {
            return response()->json(['message' => 'Recommended item not found'], 404);
        }
        return new RecommendedResource($item);
    }

    // Create a recommended item
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'nullable|exists:single_products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'estimated_price' => 'nullable|numeric',
            'image' => 'nullable|image|max:5120', // optional image (max 5MB)
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : 1;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/Recommended');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/Recommended/' . $filename;
        }

        $item = Recommended::create($data);

        return new RecommendedResource($item);
    }

    // Update a recommended item
    public function update(Request $request, $id)
    {
        $item = Recommended::find($id);
        if (!$item) {
            return response()->json(['message' => 'Recommended item not found'], 404);
        }

        $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'product_id' => 'nullable|exists:single_products,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'sometimes|integer|min:1',
            'estimated_price' => 'nullable|numeric',
            'image' => 'nullable|image|max:5120', // optional image
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : $item->is_active;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/Recommended');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);

            // Delete old image if exists
            if ($item->image && file_exists(public_path($item->image))) {
                @unlink(public_path($item->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/Recommended/' . $filename;
        }

        $item->update($data);

        return new RecommendedResource($item);
    }

    // Delete a recommended item
    public function destroy($id)
    {
        $item = Recommended::find($id);
        if (!$item) {
            return response()->json(['message' => 'Recommended item not found'], 404);
        }

        // Delete image file if exists
        if ($item->image && file_exists(public_path($item->image))) {
            @unlink(public_path($item->image));
        }

        $item->delete();

        return response()->json(['message' => 'Recommended item deleted successfully']);
    }
}