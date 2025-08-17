@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Add Single Product
            <a href="{{ route('single-products.index') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('single-products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select name="is_active" class="form-control" required>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
        </form>
    </div>
</div>
@endsection