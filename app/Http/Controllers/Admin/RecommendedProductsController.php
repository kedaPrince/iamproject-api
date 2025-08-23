<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Recommended;
use App\Models\SingleProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class RecommendedProductsController extends Controller
{
    public function index()
    {
        $recommendedItems = Recommended::with(['category', 'product'])->get();
        return view('admin.recommended.index', compact('recommendedItems'));
    }

    public function create()
    {
        $categories = Category::where('status', 0)->get();
        $products = SingleProducts::where('is_active', 1)->get();
        return view('admin.recommended.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'product_id'     => 'nullable|exists:single_products,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'quantity'       => 'required|integer|min:1',
            'estimated_price'=> 'nullable|numeric',
            'image'          => 'nullable|image|max:5120', // max 5MB
            'is_active'      => 'boolean',
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

        Recommended::create($data);

        return redirect()->route('recommended.index')
            ->with('status', 'Recommended Product Created Successfully');
    }

    public function edit(Recommended $recommended)
    {
        $categories = Category::where('status', 0)->get();
        $products = SingleProducts::where('is_active', 1)->get();
        return view('admin.recommended.edit', compact('recommended', 'categories', 'products'));
    }

    public function update(Request $request, Recommended $recommended)
    {
        $request->validate([
            'category_id'    => 'sometimes|exists:categories,id',
            'product_id'     => 'nullable|exists:single_products,id',
            'name'           => 'sometimes|string|max:255',
            'description'    => 'nullable|string',
            'quantity'       => 'sometimes|integer|min:1',
            'estimated_price'=> 'nullable|numeric',
            'image'          => 'nullable|image|max:5120', // max 5MB
            'is_active'      => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : $recommended->is_active;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/Recommended');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);

            // Delete old image if exists
            if ($recommended->image && file_exists(public_path($recommended->image))) {
                @unlink(public_path($recommended->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            $data['image'] = 'uploads/Recommended/' . $filename;
        }

        $recommended->update($data);

        return redirect()->route('recommended.index')
            ->with('status', 'Recommended Product Updated Successfully');
    }

    public function destroy(Recommended $recommended)
    {
        if ($recommended->image && file_exists(public_path($recommended->image))) {
            @unlink(public_path($recommended->image));
        }

        $recommended->delete();
        return redirect()->route('recommended.index')
            ->with('status', 'Recommended Product Deleted Successfully');
    }

    public function show(Recommended $recommended)
    {
        return view('admin.recommended.show', compact('recommended'));
    }
}