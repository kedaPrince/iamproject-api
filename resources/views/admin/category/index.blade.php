@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Categories
            <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary float-end">Add Category</a>
        </h4>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categories List
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Popular</th>
                        <th>Image</th>
                        <th>Created at</th>
                        <th style="width:160px;">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Popular</th>

                        <th>Image</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($category->description, 80) }}</td>

                        {{-- If your migration stores status as "active"/"inactive": --}}
                        <td>
                            @if((int) $category->status === 0)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>


                        <td>
                            @if((int) $category->popular === 1)
                            <span class="badge bg-info">Yes</span>
                            @else
                            <span class="badge bg-light text-dark">No</span>
                            @endif
                        </td>

                        <td>
                            @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="height:40px;">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ optional($category->created_at)->format('Y-m-d H:i') }}</td>

                        <td>
                            <a href="{{ url('/admin/categories/'.$category->id) }}"
                                class="btn btn-sm btn-outline-secondary">
                                View
                            </a>
                            <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}"
                                class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>
                            <form action="{{ url('/admin/categories/'.$category->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection