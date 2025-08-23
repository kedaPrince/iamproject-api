<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SingleProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\SingleProductFormRequest;

class SingleProductsController extends Controller
{
<<<<<<< Updated upstream
    public function index()
    {
        // Fetch all products with their category
        $singleProducts = SingleProducts::with('category')->get();
        return view('admin.single_product.index', compact('singleProducts'));
    }

    public function create()
    {
        $categories = Category::where('status', 0)->get(); // Active categories
        return view('admin.single_product.create', compact('categories'));
    }

public function store(SingleProductFormRequest $request)
{
    \Log::info('PHP upload limits:', [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size')
    ]);
    if ($request->hasFile('image')) {
        \Log::info('Image MIME type:', [$request->file('image')->getClientMimeType()]);
        \Log::info('Image file size:', [$request->file('image')->getSize() / 1024 . ' KB']);
        \Log::info('File valid:', [$request->file('image')->isValid()]);
    }

    try {
        $data = $request->validated();
        \Log::info('Validated data:', $data);
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::info('Validation errors:', $e->errors());
        throw $e;
    }

    $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
    $data['uuid'] = $data['uuid'] ?? (string) Str::uuid();
    $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : 0;

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $uploadPath = public_path('uploads/SingleProducts');
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);
        $file = $request->file('image');
        $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        try {
            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/SingleProducts/' . $filename;
            \Log::info('Image path set:', [$data['image']]);
        } catch (\Exception $e) {
            \Log::error('File move failed:', ['error' => $e->getMessage()]);
            throw $e;
        }
    } else {
        \Log::info('No valid image uploaded');
    }

    \Log::info('Data before saving:', $data);
    try {
        SingleProducts::create($data);
    } catch (\Exception $e) {
        \Log::error('Database save failed:', ['error' => $e->getMessage()]);
        throw $e;
    }

    return redirect()->route('single-products.index')->with('status', 'Single Product Created');
}
    public function edit(SingleProducts $singleProduct)
    {
        $categories = Category::where('status', 0)->get();
        return view('admin.single_product.edit', compact('singleProduct', 'categories'));
    }

    public function update(SingleProductFormRequest $request, SingleProducts $singleProduct)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['uuid'] = $data['uuid'] ?? (string) Str::uuid();
        $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadPath = public_path('uploads/SingleProducts');
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0775, true);

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

            // Delete old image
            if ($singleProduct->image && file_exists(public_path($singleProduct->image))) {
                @unlink(public_path($singleProduct->image));
            }

            $file->move($uploadPath, $filename);
            $data['image'] = 'uploads/SingleProducts/' . $filename;
        }

        $singleProduct->update($data);

        return redirect()->route('single-products.index')
            ->with('status', 'Single Product Updated');
    }

    public function destroy(SingleProducts $singleProduct)
    {
        if ($singleProduct->image && file_exists(public_path($singleProduct->image))) {
            @unlink(public_path($singleProduct->image));
        }
        $singleProduct->delete();
        return redirect()->route('single-products.index')
            ->with('status', 'Single Product Deleted');
    }

    public function show(SingleProducts $singleProduct)
    {
        return view('admin.single_product.show', compact('singleProduct'));
=======
    public function index(){
        return view('admin.single_product.index');
    }

    public function create(){
        return view('admin.single_product.create');
>>>>>>> Stashed changes
    }
}