<div class="sidebar text-white p-3" style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0;background-color: rgb(6, 88, 132);">
    <h4 class="text-center mb-4 fw-bold">ADMIN</h4>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}"
                class="nav-link text-white d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                <span class="fw-semibold" style="font-size: 15px;">Dashboard</span>
            </a>
        </li>


        <!-- Item Master -->
        <li class="nav-item mb-2">
            <a href="{{ route('categories.index') }}"
                class="nav-link text-white d-flex align-items-center {{ request()->routeIs('categories.*') ? 'active fw-bold text-primary' : '' }}">
                <i class="bi bi-tags me-2"></i>
                <span class="fw-semibold" style="font-size: 15px;">Category</span>
            </a>
        </li>   

        <!-- Users Dropdown -->
        @php
        $userRoutes = ['users.index', 'users.create', 'users.edit', 'users.update', 'users.destroy'];
        $isUserActive = request()->routeIs(...$userRoutes);
        @endphp

        @if(auth()->user()->role === 'Admin')
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center {{ $isUserActive ? 'text-primary fw-bold' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#userMenu" role="button"
                aria-expanded="{{ $isUserActive ? 'true' : 'false' }}" aria-controls="userMenu">
                <span class="d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <span class="fw-semibold" style="font-size: 15px;">Users Admin</span>
                </span>
                <i class="bi bi-chevron-down small"></i>
            </a>

            <div class="collapse {{ $isUserActive ? 'show' : '' }}" id="userMenu">
                <ul class="nav flex-column ms-3 mt-2">
                    <li class="nav-item mb-1">
                        <a href="{{ route('users.create') }}"
                            class="nav-link text-white d-flex align-items-center {{ request()->routeIs('users.create') ? 'active fw-bold text-primary' : '' }}">
                            <i class="bi bi-person-plus me-2"></i>
                            <span class="fw-semibold">Add User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link text-white d-flex align-items-center {{ request()->routeIs('users.index') || request()->routeIs('users.edit') || request()->routeIs('users.update') ? 'active fw-bold text-primary' : '' }}">
                            <i class="bi bi-list me-2"></i>
                            <span class="fw-semibold">List User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif


    </ul>
</div>