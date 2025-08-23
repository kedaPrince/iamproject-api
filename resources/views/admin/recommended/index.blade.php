@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Recommended Products
            <a href="{{ route('recommended.create') }}" class="btn btn-primary float-end">Add Recommended Product</a>
        </h4>
    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Linked Product</th>
                    <th>Quantity</th>
                    <th>Estimated Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recommendedItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name ?? 'Uncategorized' }}</td>
                    <td>{{ $item->product->name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->estimated_price ? 'R '.number_format($item->estimated_price, 2) : '-' }}</td>
                    <td>
                        @if($item->is_active)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($item->image)
                        <img src="{{ asset($item->image) }}" style="height:40px;">
                        @else
                        <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ optional($item->created_at)->format('Y-m-d H:i') }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('recommended.show', $item->id) }}" class="btn btn-sm btn-info"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('recommended.edit', $item->id) }}" class="btn btn-sm btn-success"><i
                                class="fa fa-pencil"></i></a>
                        <form action="{{ route('recommended.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Delete this recommended item?');" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit"><i
                                    class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No recommended products yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection