@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Add Recommended Product
            <a href="{{ route('recommended.index') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('recommended.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <!-- Category -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Linked Product -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Linked Product (optional)</label>
                    <select name="product_id" class="form-control">
                        <option value="">None</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id')==$product->id ? 'selected' : '' }}>
                            {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Description -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <!-- Quantity -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity',1) }}" min="1"
                        required>
                </div>

                <!-- Estimated Price -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estimated Price</label>
                    <input type="number" name="estimated_price" class="form-control"
                        value="{{ old('estimated_price') }}" step="0.01">
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control" required>
                        <option value="1" {{ old('is_active',1)==1?'selected':'' }}>Active</option>
                        <option value="0" {{ old('is_active')=='0'?'selected':'' }}>Inactive</option>
                    </select>
                </div>

                <!-- Image -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Save Recommended Product</button>
        </form>
    </div>
</div>
@endsection