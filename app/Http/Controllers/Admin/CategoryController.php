<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

public function store(CategoryFormRequest $request)
{
    $data = $request->validated();
    \Log::info('Validated data:', $data); // Log validated data
    \Log::info('Has file:', [$request->hasFile('image')]);
    \Log::info('File valid:', [$request->file('image') ? $request->file('image')->isValid() : null]);

    $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
    $data['uuid'] = $data['uuid'] ?? (string) Str::uuid();
    $data['status'] = isset($data['status']) ? (int) $data['status'] : 0;
    $data['popular'] = isset($data['popular']) ? (int) $data['popular'] : 0;

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $uploadPath = public_path('uploads/category');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }
        $file = $request->file('image');
        $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $data['image'] = 'uploads/category/' . $filename;
        \Log::info('Image path set:', [$data['image']]); // Log the image path
    } else {
        \Log::info('No valid image uploaded');
    }

    \Log::info('Data before saving:', $data); // Log final data
    if ($request->hasFile('image')) {
    \Log::info('Image MIME type:', [$request->file('image')->getClientMimeType()]);
}
    Category::create($data);

    return redirect('/admin/categories')->with('status', 'Category Created');
}


}