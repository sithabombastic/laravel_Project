@extends('layouts.app')

@section('title', 'Add Item')

@section('content')
<div class="container mt-4">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color:  rgb(0, 166, 255)">
            <h5 class="mb-0" style="font-family: AKbalthom;">Add New Item</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light text-dark">
                ← Back to List
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="number" name="sku" id="sku" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" name="barcode" id="barcode" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (EN)</label>
                    <input type="text" name="name_en" id="name_en" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="name_kh" class="form-label">Name (KH)</label>
                    <input type="text" name="name_kh" id="name_kh" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>

                <!-- Image Preview -->
                <div class="mb-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="display:none; max-width: 150px; border-radius: 6px;">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Add Item</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Image Preview -->
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

<script>
    if (performance.navigation.type === 1) {
        window.location.href = "{{ route('dashboard') }}";
    }
</script>