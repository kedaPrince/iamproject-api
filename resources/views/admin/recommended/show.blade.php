@extends('layouts.admin')

@section('content')
@php
$statusLabel = $recommended->is_active ? ['text'=>'Active','class'=>'badge bg-success'] : ['text'=>'Inactive','class'=>'badge bg-secondary'];
@endphp

<div class="card mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Show Recommended Product</h4>
        <a href="{{ route('recommended.index') }}" class="btn btn-light btn-sm">Back</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h3>{{ $recommended->name }}</h3>
                <p><span class="{{ $statusLabel['class'] }}">{{ $statusLabel['text'] }}</span></p>
                <p><strong>Category:</strong> {{ $recommended->category->name ?? '-' }}</p>
                <p><strong>Linked Product:</strong> {{ $recommended->product->name ?? '-' }}</p>
                <p><strong>Quantity:</strong> {{ $recommended->quantity }}</p>
                <p><strong>Estimated Price:</strong> {{ $recommended->estimated_price ? 'R '.number_format($recommended->estimated_price,2) : '-' }}</p>
                <p><strong>Description:</strong> {{ $recommended->description ?? 'No description' }}</p>
            </div>
            <div class="col-md-6 text-center">
                @if($recommended->image)
                <img src="{{ asset($recommended->image) }}" style="max-width:100%;border-radius:6px;">
                @else
                <div class="border p-5 text-muted">No image uploaded</div>
                @endif
                <div class="mt-3 d-flex gap-2 justify-content-center">
                    <a href="{{ route('recommended.edit',$recommended->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('recommended.destroy',$recommended->id) }}" method="POST" onsubmit="return confirm('Delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
