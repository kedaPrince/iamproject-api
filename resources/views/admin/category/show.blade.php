@extends('layouts.admin')

@section('content')
@php
// Helper labels
$statusLabel = ((int)$category->status === 0) ? ['text'=>'Active','class'=>'badge bg-success'] :
['text'=>'Inactive','class'=>'badge bg-secondary'];
$popularLabel = ((int)$category->popular === 1) ? ['text'=>'Yes','class'=>'badge bg-info'] :
['text'=>'No','class'=>'badge bg-light text-dark'];
@endphp

<style>
/* Minimal styles adapted from the CodePen layout */
.two-column-container {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
    margin-top: 1rem;
}

.left-column {
    flex: 1 1 55%;
}

.right-column {
    flex: 0 0 40%;
    text-align: center;
}

.product-name {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: .25rem;
}

.structured-data .badge {
    margin-right: .4rem;
}

.product-image img {
    max-width: 100%;
    border-radius: 6px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
}

.metadata-label {
    font-weight: 600;
    color: #444;
}

.table-plain {
    width: 100%;
    border-collapse: collapse;
    margin-top: .75rem;
}

.table-plain td {
    padding: .45rem .6rem;
    vertical-align: top;
    border-top: 1px solid #eee;
}

.card-header.bg-primary {
    background: #007bff;
    color: #fff;
}

.meta-small {
    font-size: .9rem;
    color: #666;
}

@media (max-width: 767px) {
    .two-column-container {
        flex-direction: column-reverse;
    }

    .right-column {
        text-align: left;
    }
}
</style>

<div class="card mt-4 shadow-sm">
    <div class="card-header bg-primary">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Show Category</h4>
            <a href="{{ url('/admin/categories') }}" class="btn btn-light btn-sm">Back</a>
        </div>
    </div>

    <div class="card-body">
        <div class="two-column-container">

            <!-- LEFT: details -->
            <div class="left-column">
                <div class="product-details">
                    <div class="d-flex align-items-start justify-content-between mb-2">
                        <div>
                            <h1 class="product-name">{{ $category->name }}</h1>
                            <div class="structured-data mb-2">
                                {{-- Category-level badges --}}
                                <span class="{{ $statusLabel['class'] }}">{{ $statusLabel['text'] }}</span>
                                <span class="{{ $popularLabel['class'] }}"
                                    title="Popular">{{ $popularLabel['text'] }}</span>
                                @if($category->meta_title)
                                <span
                                    class="badge bg-light text-dark">{{ Str::limit($category->meta_title, 30) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="meta-small text-end">
                            <div><strong>ID:</strong> {{ $category->id }}</div>
                            <div><strong>Created:</strong> {{ optional($category->created_at)->format('Y-m-d') }}</div>
                            <div><strong>Updated:</strong> {{ optional($category->updated_at)->format('Y-m-d') }}</div>
                        </div>
                    </div>

                    {{-- small metadata table --}}
                    <table class="table-plain">
                        <tbody>
                            <tr>
                                <td class="metadata-label">Slug</td>
                                <td>{{ $category->slug ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="metadata-label">Meta keywords</td>
                                <td>{{ $category->meta_keyword ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="metadata-label">Meta description</td>
                                <td class="meta-small">{{ $category->meta_description ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div>
                    <h5>Description</h5>
                    <p class="mb-3">{{ $category->description ?? 'No description provided.' }}</p>
                </div>

                <div>
                    <h5>Additional Info</h5>
                    <ul class="list-unstyled">
                        <li><strong>UUID:</strong> {{ (string) $category->uuid }}</li>
                        <li><strong>Popular:</strong> {{ (int)$category->popular === 1 ? 'Yes' : 'No' }}</li>
                        <li><strong>Status:</strong> {{ (int)$category->status === 0 ? 'Active' : 'Inactive' }}</li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT: image / actions -->
            <div class="right-column">
                <div class="product-image mb-3">
                    @if($category->image)
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                    @else
                    <div class="border rounded p-4 text-muted">
                        No image uploaded
                    </div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ url('/admin/categories/'.$category->id) }}" method="POST"
                        onsubmit="return confirm('Delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            </div>

        </div> {{-- two-column-container --}}
    </div>
</div>
@endsection