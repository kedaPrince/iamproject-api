@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Edit Recommended Product
            <a href="{{ route('recommended.index') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('recommended.update', $recommended->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $recommended->category_id==$category->id ? 'selected':'' }}>{{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Linked Product (optional)</label>
                    <select name="product_id" class="form-control">
                        <option value="">None</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $recommended->product_id==$product->id?'selected':'' }}>
                            {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name',$recommended->name) }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                        rows="3">{{ old('description',$recommended->description) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                        value="{{ old('quantity',$recommended->quantity) }}" min="1" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estimated Price</label>
                    <input type="number" name="estimated_price" class="form-control"
                        value="{{ old('estimated_price',$recommended->estimated_price) }}" step="0.01">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $recommended->is_active==1?'selected':'' }}>Active</option>
                        <option value="0" {{ $recommended->is_active==0?'selected':'' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    @if($recommended->image)
                    <div class="mt-2">
                        <img src="{{ asset($recommended->image) }}"
                            style="width:120px;height:120px;object-fit:cover;border:1px solid #ddd;padding:3px;">
                    </div>
                    @endif
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Update Recommended Product</button>
        </form>
    </div>
</div>
@endsection