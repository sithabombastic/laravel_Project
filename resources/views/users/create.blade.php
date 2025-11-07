<script>
    if (performance.navigation.type === 1) {
        window.location.href = "{{ route('dashboard') }}";
    }
</script>

@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border rounded shadow-sm">
                <div class="card-header text-white" style="background-color:rgb(12, 182, 254);">
                    <h5 class="mb-0" style="font-family: AKbalthom; color: rgb(255, 255, 255);">Add User</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control border" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control border" placeholder="Enter email address" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">User Privilege</label>
                            <select name="role" id="role" class="form-select">
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="password" class="form-label">Password <small class="text-muted">(minimum 8 characters)</small></label>
                            <input type="password" name="password" id="password" class="form-control border" placeholder="Create password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border" placeholder="Confirm password" required>
                        </div>

                        <div class="mb-3 p-3 border rounded bg-light">
                            <div class="form-check">
                                <input style="border: 1px solid rgb(12, 182, 254));" class="form-check-input" type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                                <label class="form-check-label fw-semibold" for="showPassword">Show Password</label>
                            </div>
                        </div>


                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Add NEw</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -- Show Password Script -- -->
<script>
    function togglePasswordVisibility() {
        const password = document.getElementById("password");
        const confirm = document.getElementById("password_confirmation");
        const type = password.type === "password" ? "text" : "password";
        password.type = type;
        confirm.type = type;
    }
</script>
@endsection