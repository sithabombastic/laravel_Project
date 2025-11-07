<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> NPIT SHOP</title>
    
    <link rel="icon" href="{{ asset('img/burger.jpg') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-overlay {
            background: rgba(89, 89, 89, 0.5);
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style> 
</head>

<body>
    @yield('content')
</body>

</html>