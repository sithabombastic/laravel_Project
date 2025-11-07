@extends('layouts.app')

@section('title', 'Edit Item')


@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: rgb(0, 166, 255)">
            <h5 class="mb-0" style="font-family: Superhero;">Edit Item</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light text-dark">
                ← Back to List
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $category->sku) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $category->barcode) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (EN)</label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $category->name_en) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="name_kh" class="form-label">Name (KH)</label>
                    <input type="text" name="name_kh" id="name_kh" value="{{ old('name_kh', $category->name_kh) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $category->price) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Change Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">

                    <div class="mt-2">
                        @if($category->image && file_exists(public_path('storage/' . $category->image)))
                        <img id="currentImage" src="{{ asset('storage/' . $category->image) }}" width="100" style="border-radius: 6px;">
                        @else
                        <span>No image available</span>
                        @endif
                    </div>

                    <div class="mt-2">
                        <img id="preview" src="#" alt="New Image Preview" style="display:none; border-radius: 6px;" width="100">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update Item</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection


