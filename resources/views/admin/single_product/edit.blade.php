@extends('layouts.admin')

@section('content')
<style>
/* Kept minimal styles to avoid duplication */
.form-control,
.form-select {
    height: 50px;
    background: #ecf0f4;
    border-color: transparent;
    padding: 0 15px;
    font-size: 16px;
    transition: all .3s;
}

.form-control textarea {
    height: auto;
}

.form-wrap {
    background: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 0 40px rgba(0, 0, 0, .15);
    position: relative;
}

.card {
    border: none !important;
}
</style>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Edit Single Product
            <a href="{{ route('single-products.index') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>

    <div class="card-body">
        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Success flash --}}
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="form-wrap">
            <form action="{{ route('single-products.update', $singleProduct->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $singleProduct->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $singleProduct->name) }}" required>
                    </div>

                    <!-- Slug -->
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $singleProduct->slug) }}" readonly>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            rows="3">{{ old('description', $singleProduct->description) }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ old('price', $singleProduct->price) }}" step="0.01" required>
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock', $singleProduct->stock) }}" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="is_active" class="form-label">Status</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="1" {{ old('is_active', $singleProduct->is_active) == 1 ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('is_active', $singleProduct->is_active) == 0 ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($singleProduct->image)
                        <div class="mt-2">
                            <p class="mb-1">Current image:</p>
                            <img src="{{ asset($singleProduct->image) }}" alt="{{ $singleProduct->name }}"
                                style="width:120px; height:120px; object-fit:cover; border:1px solid #ddd; padding:3px;">
                        </div>
                        @else
                        <div class="mt-2 text-muted">No image uploaded</div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update Product</button>
            </form>
        </div>
    </div>
</div>
@endsection