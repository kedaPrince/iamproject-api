@extends('layouts.admin')

@section('content')
<style>
/* kept minimal styles to avoid duplication */
.form-control {
    height: 50px;
    background: #ecf0f4;
    border-color: transparent;
    padding: 0 15px;
    font-size: 16px;
    transition: all .3s;
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
            Edit Category
            <a href="{{ url('/admin/categories') }}" class="btn btn-danger float-end">Back</a>
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
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $category->name) }}" required>
                    </div>

                    <!-- Slug -->
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $category->slug) }}" readonly>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ (old('status', $category->status) == 0) ? 'selected' : '' }}>Active
                            </option>
                            <option value="1" {{ (old('status', $category->status) == 1) ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Popular -->
                    <div class="col-md-6 mb-3">
                        <label for="popular" class="form-label">Popular</label>
                        <select name="popular" id="popular" class="form-control">
                            <option value="1" {{ (old('popular', $category->popular) == 1) ? 'selected' : '' }}>Yes
                            </option>
                            <option value="0" {{ (old('popular', $category->popular) == 0) ? 'selected' : '' }}>No
                            </option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">

                        @if($category->image)
                        <div class="mt-2">
                            <p class="mb-1">Current image:</p>
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                style="width:120px; height:120px; object-fit:cover; border:1px solid #ddd; padding:3px;">
                        </div>
                        @else
                        <div class="mt-2 text-muted">No Image uploaded</div>
                        @endif
                    </div>

                    <!-- Meta Title -->
                    <div class="col-md-6 mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                            value="{{ old('meta_title', $category->meta_title) }}">
                    </div>

                    <!-- Meta Description -->
                    <div class="col-md-6 mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control"
                            rows="2">{{ old('meta_description', $category->meta_description) }}</textarea>
                    </div>

                    <!-- Meta Keyword -->
                    <div class="col-md-6 mb-3">
                        <label for="meta_keyword" class="form-label">Meta Keyword</label>
                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"
                            value="{{ old('meta_keyword', $category->meta_keyword) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update Category</button>
            </form>
        </div>
    </div>
</div>
@endsection