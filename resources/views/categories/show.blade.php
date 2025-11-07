@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-family: AKbalthom Superhero; color: white;">Item Details</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light text-dark">
                ← Back to List
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Item details on the left -->
                <div class="col-md-8">
                    <div class="border rounded p-3 mb-2">
                        <strong>SKU:</strong> {{ $category->sku }}
                    </div>
                    <div class="border rounded p-3 mb-2">
                        <strong>Barcode:</strong> {{ $category->barcode }}
                    </div>
                    <div class="border rounded p-3 mb-2">
                        <strong>Name (EN):</strong> {{ $category->name_en }}
                    </div>
                    <div class="border rounded p-3 mb-2">
                        <strong>Name (KH):</strong> {{ $category->name_kh }}
                    </div>
                    <div class="border rounded p-3 mb-2">
                        <strong>Price:</strong> ${{ number_format($category->price, 2) }}
                    </div>
                </div>

                <!-- Image on the right -->
                <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                    @php
                    $imagePath = public_path('storage/' . $category->image);
                    @endphp

                    @if($category->image && file_exists($imagePath))
                    <img src="{{ asset('storage/' . $category->image) }}" style="max-width: 100%; max-height: 250px; border-radius: 8px;">
                    @else
                    <div class="text-muted" style="font-style: italic;">No Image Available</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection