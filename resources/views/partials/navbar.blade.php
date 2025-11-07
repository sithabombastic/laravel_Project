<head>
    <!-- Other head content -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .dropdown-menu .dropdown-item:hover {
            background-image: none !important;
            background-color: #b0aeaeff !important;
            color: rgb(255, 255, 255) !important;
        }

        .dropdown-menu .dropdown-item:hover i {
            color: #ffffff !important;
        }

        .profile-img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light ps-3" style="margin-left: 250px; border-bottom: 12px solid rgb(0, 195, 255);">
    <div class="container-fluid">
        <span class="navbar-brand">
            NPIT Admin
        </span>

        <ul class="navbar-nav ms-auto me-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn btn-secondary text-white user-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('img/default-avatar.png') }}" alt=" " class="profile-img">
                    <span>{{ auth()->user()->name ?? 'User' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="bi bi-person-circle"></i> Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Bootstrap JS dependencies for dropdown functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>