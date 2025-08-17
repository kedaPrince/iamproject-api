@extends('layouts.admin')

@section('content')
<style>
.form-control {
    height: 50px;
    background: #ecf0f4;
    border-color: transparent;
    padding: 0 15px;
    font-size: 16px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.form-wrap {
    background: rgba(255, 255, 255, 1);
    width: 100%;

    padding: 50px;
    margin: 0 auto;
    position: relative;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}

.form-wrap:before {
    content: "";
    width: 90%;
    height: calc(100% + 60px);
    left: 0;
    right: 0;
    margin: 0 auto;
    position: absolute;
    top: -30px;
    background: #00bcd9;
    z-index: -1;
    opacity: 0.8;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}

.btn {
    padding: 0.27rem .25rem;
    font-size: 15px;
    letter-spacing: 0.050em;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;

}

.btn-primary {
    color: #fff;
    background-color: #00bcd9 !important;
    border-color: #00bcd9;
}

.btn-primary:hover {
    color: #00bcd9 !important;
    background-color: #ffffff;
    border-color: #00bcd9;
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.btn-primary:focus,
.btn-primary.focus {
    color: #00bcd9 !important;
    background-color: #ffffff;
    border-color: #00bcd9;
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.btn-primary:not(:disabled):not(.disabled):active,
.btn-primary:not(:disabled):not(.disabled).active,
.show>.btn-primary.dropdown-toggle {
    color: #00bcd9;
    background-color: #ffffff;
    border-color: #00bcd9;
}

.btn-primary:not(:disabled):not(.disabled):active:focus,
.btn-primary:not(:disabled):not(.disabled).active:focus,
.show>.btn-primary.dropdown-toggle:focus {
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.form-control {
    height: 50px;
    background: #ecf0f4;
    border-color: transparent;
    padding: 0 15px;
    font-size: 16px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #00bcd9;
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.card {
    border: none !important;
}
</style>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Single Products
            <a href="{{ url('/admin/single-products/create') }}" class="btn btn-primary float-end">Add Single
                Product</a>
        </h4>
    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table id="datatablesSimple" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($singleProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($product->description, 80) }}</td>
                    <td>R {{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->is_active)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="height:40px;">
                        @else
                        <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ optional($product->created_at)->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <!-- flex container for inline buttons -->

                            <a href="{{ route('single-products.show', $product->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>

                            <a href="{{ url('/admin/single-products/'.$product->id.'/edit') }}"
                                class="btn btn-sm btn-success">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>

                            <form action="{{ route('single-products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Delete this single product?');" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No products found.</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection