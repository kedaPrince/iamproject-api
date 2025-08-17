@extends('layouts.admin')

@section('content')
@php
// Helper labels
$statusLabel = ((int)$singleProduct->is_active === 1) ? ['text'=>'Active','class'=>'badge bg-success'] :
['text'=>'Inactive','class'=>'badge bg-secondary'];
@endphp

<style>
/* Minimal styles adapted from the Category show layout */
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
            <h4 class="mb-0">Show Single Product</h4>
            <a href="{{ route('single-products.index') }}" class="btn btn-light btn-sm">Back</a>
        </div>
    </div>

    <div class="card-body">
        <div class="two-column-container">

            <!-- LEFT: details -->
            <div class="left-column">
                <div class="product-details">
                    <div class="d-flex align-items-start justify-content-between mb-2">
                        <div>
                            <h1 class="product-name">{{ $singleProduct->name }}</h1>
                            <div class="structured-data mb-2">
                                <span class="{{ $statusLabel['class'] }}">{{ $statusLabel['text'] }}</span>
                                <span class="badge bg-light text-dark">
                                    Category: {{ $singleProduct->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                        <div class="meta-small text-end">
                            <div><strong>ID:</strong> {{ $singleProduct->id }}</div>
                            <div><strong>Created:</strong> {{ optional($singleProduct->created_at)->format('Y-m-d') }}
                            </div>
                            <div><strong>Updated:</strong> {{ optional($singleProduct->updated_at)->format('Y-m-d') }}
                            </div>
                        </div>
                    </div>

                    <!-- Metadata table -->
                    <table class="table-plain">
                        <tbody>
                            <tr>
                                <td class="metadata-label">Slug</td>
                                <td>{{ $singleProduct->slug ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="metadata-label">Price</td>
                                <td>R {{ number_format($singleProduct->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="metadata-label">Stock</td>
                                <td>{{ $singleProduct->stock }}</td>
                            </tr>
                            <h5>Additional Info</h5>
                            <tr>
                                <td class="metadata-label">
                                    <h5>Description</h5>
                                </td>
                                <td>
                                    <p class="mb-3">{{ $singleProduct->description ?? 'No description provided.' }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <table>
                    <tbody>


                        <div>

                            <ul class="list-unstyled">
                                <li><strong>UUID:</strong> {{ (string) $singleProduct->uuid }}</li>
                                <li><strong>Category ID:</strong> {{ $singleProduct->category_id }}</li>
                                <li><strong>Status:</strong>
                                    {{ (int)$singleProduct->is_active === 1 ? 'Active' : 'Inactive' }}
                                </li>
                            </ul>
                        </div>
                    </tbody>
                </table>
            </div>

            <!-- RIGHT: image / actions -->
            <div class="right-column">
                <div class="product-image mb-3">
                    @if($singleProduct->image)
                    <img src="{{ asset($singleProduct->image) }}" alt="{{ $singleProduct->name }}">
                    @else
                    <div class="border rounded p-4 text-muted">
                        No image uploaded
                    </div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('single-products.edit', $singleProduct->id) }}"
                        class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('single-products.destroy', $singleProduct->id) }}" method="POST"
                        onsubmit="return confirm('Delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            </div>

        </div> <!-- two-column-container -->
    </div>
</div>
@endsection