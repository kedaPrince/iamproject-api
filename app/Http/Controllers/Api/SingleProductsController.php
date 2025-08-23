<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SingleProducts;
use App\Http\Resources\SingleProductsResource;
use Illuminate\Support\Str;

class SingleProductsController extends Controller
{
    // Get all single products
    public function index()
    {
        $products = SingleProducts::with('category')->get();
        return SingleProductsResource::collection($products);
    }

    // Get a single product by ID
    public function show($id)
    {
        $product = SingleProducts::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return new SingleProductsResource($product);
    }

    // Create a new single product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $product = SingleProducts::create([
            'uuid' => Str::uuid(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'is_active' => $request->is_active ?? true,
        ]);

        return new SingleProductsResource($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = SingleProducts::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'image' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->has('name')) {
            $product->slug = Str::slug($request->name);
        }

        $product->update($request->all());

        return new SingleProductsResource($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = SingleProducts::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}