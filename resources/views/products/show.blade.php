@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card product-details">
                <div class="card-header">
                    <h1>Product Details</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-info">
                                <div><strong>Name:</strong> {{ $product->name }}</div>
                                <div><strong>Category:</strong> {{ $product->category }}</div>
                                <div><strong>Release Date:</strong> {{ $product->release_date }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-image">
                                @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="img-fluid">
                                @else
                                <p class="text-center">No image available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="product-description">
                        <strong>Description:</strong>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection