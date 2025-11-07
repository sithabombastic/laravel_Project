@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border rounded shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-family: AKbalthom Superhero;">Edit User</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light custom-back-btn">
                        &larr; Back to List User
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control border @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control border @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">User Privilege</label>
                            <select name="role" id="role"
                                class="form-select @error('role') is-invalid @enderror">
                                <option value="User" {{ old('role', $user->role) === 'User' ? 'selected' : '' }}>User</option>
                                <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <em class="text-muted">*leave blank to keep current</em></label>
                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter new password">

                            @error('password')
                            <div class="invalid-feedback d-block mt-1">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm new password">

                            @error('password_confirmation')
                            <div class="invalid-feedback d-block mt-1">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror

                        </div>




                        <div class="mb-3 p-3 border rounded bg-light">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                                <label class="form-check-label fw-semibold" for="showPassword">
                                    Show Password
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>

                    {{-- Show Password Script --}}
                    <script>
                        function togglePasswordVisibility() {
                            const password = document.getElementById("password");
                            const confirm = document.getElementById("password_confirmation");
                            const type = password.type === "password" ? "text" : "password";
                            password.type = type;
                            confirm.type = type;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection