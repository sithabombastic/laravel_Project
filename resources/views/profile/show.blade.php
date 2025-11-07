@extends('layouts.app')

@section('content')


<div class="container py-4">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="alert alert-danger mt-2">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="card-header text-dark d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-family: AKbalthom Superhero;">Profile</h5>
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-light text-dark">
            ← Back to List
        </a>
    </div>

    {{-- Profile Update Form --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
                </div>


                {{-- Email Using Role--}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>

                    @if(auth()->user()->role === 'Admin')
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                    @else
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    @endif
                </div>

                {{-- User Privilege Using Role--}}
                @if(auth()->user()->role === 'Admin')
                <div class="mb-3">
                    <label for="role" class="form-label fw-bold">User Privilege</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="User" {{ old('role', $user->role) === 'User' ? 'selected' : '' }}>User</option>
                        <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                @else
                <input type="hidden" name="role" value="{{ $user->role }}">
                @endif



                {{-- Placeholder for Upload Form --}}
                <div id="upload-placeholder" class="mb-3"></div>

                <!-- Display Current Image If User have profile image -->
                {{-- Current Photo --}}
                @if(auth()->user()->photo)
                <div class="mb-3">
                    <label for="photo-input" class="form-label fw-bold">Photo</label>

                    <div>
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile Photo" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>

                    <div class="mt-2">
                        <p style="color: #8a8888ff; font-size:14px;">
                            <i>* If you want to upload another file, please delete the current one first.</i>
                        </p>
                    </div>

                    <div>
                        <button type="button" class="btn btn-danger btn-sm w-auto" onclick="confirmDeletePhoto()">
                            <i class="bi bi-trash-fill"></i> Delete
                        </button>
                    </div>
                </div>
                @endif

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">New Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="text-muted"><i>Leave blank if not changing</i></span>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                {{-- Save Button --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">Save</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Hidden Delete Photo Form --}}
    @if(auth()->user()->photo)
    <form id="delete-photo-form" method="POST" action="{{ route('profile.photo.delete') }}" style="display: none;">
        @csrf
    </form>
    @endif

    {{-- Auto-upload Photo Form (outside main form, injected visually) --}}
    @if(!auth()->user()->photo)
    <form id="photo-upload-form" method="POST" action="{{ route('profile.photo.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="photo-input" class="form-label fw-bold">Photo</label>
            <input type="file" name="photo" id="photo-input" class="form-control" accept=".jpg,.jpeg,.png">
            <div id="image-preview" class="mt-2"></div>
        </div>
    </form>
    @endif



</div>

{{-- JavaScript --}}
<script>
    // Inject upload form into placeholder
    window.addEventListener('DOMContentLoaded', () => {
        const uploadForm = document.getElementById('photo-upload-form');
        const placeholder = document.getElementById('upload-placeholder');
        if (uploadForm && placeholder) {
            placeholder.appendChild(uploadForm);
            uploadForm.style.display = 'block';
        }
    });

    function triggerFileInput() {
        document.getElementById('photo-input').click();
    }

    document.getElementById('photo-input')?.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').innerHTML = `
                <img src="${e.target.result}" class="img-thumbnail" style="max-width: 150px;">
            `;
            };
            reader.readAsDataURL(file);

            setTimeout(() => {
                document.getElementById('photo-upload-form').submit();
            }, 500);
        }
    });

    function confirmDeletePhoto() {
        if (confirm("Are you sure you want to delete your profile photo?")) {
            document.getElementById('delete-photo-form').submit();
        }
    }
</script>
@endsection

<script>
    if (performance.navigation.type === 1) {
        window.location.href = "{{ route('dashboard') }}";
    }
</script>