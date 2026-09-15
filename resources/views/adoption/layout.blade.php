<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PawPals - Pet Adoption')</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font (Poppins & Kanit) -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            color: #2b2d42;
            font-family: 'Poppins', 'Kanit', sans-serif;
        }

        /* Navbar Style */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            padding: 18px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #22252a !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            color: #4a5568 !important;
            margin: 0 10px;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #7c3aed !important;
        }

        /* ปุ่มสีม่วงสไตล์ PawPals */
        .btn-purple {
            background-color: #7c3aed;
            color: #ffffff;
            font-weight: 600;
            border-radius: 50px;
            padding: 10px 24px;
            border: none;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);
            transition: all 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #6d28d9;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.35);
        }

        .btn-outline-purple {
            background-color: transparent;
            color: #7c3aed;
            border: 2px solid #7c3aed;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 22px;
            transition: all 0.3s ease;
        }

        .btn-outline-purple:hover {
            background-color: #7c3aed;
            color: #ffffff;
        }

        /* ตารางปรับสไตล์สว่าง */
        .table {
            --bs-table-bg: #ffffff;
            --bs-table-color: #2b2d42;
            border-color: #edf2f7;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background-color: #f1f5f9;
            color: #64748b;
            font-weight: 600;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* รูปแบบพรีวิวรูป */
        .pet-avatar {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <!-- Header Navbar ตามแบบในรูปภาพ -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pets.index') }}">
                <i class="fa-solid fa-paw text-dark"></i> pawpals
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pets.index') }}">Adopt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pet Care</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div>
                    <a href="{{ route('pets.create') }}" class="btn btn-purple">
                        + Add Pet
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="container my-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>