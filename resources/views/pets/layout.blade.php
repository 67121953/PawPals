<!DOCTYPE html>

<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'PawPals - Pet Adoption')
    </title>


    <!-- Bootstrap 5 -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Google Font -->

    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- FontAwesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >


    <style>

        body {
            background-color: #f8f9fa;
            color: #2b2d42;
            font-family: 'Poppins', 'Kanit', sans-serif;
        }


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


        .navbar-brand i {
            font-size: 1.7rem;
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


        .nav-link.active {
            color: #7c3aed !important;
            font-weight: 600;
        }


        .btn-purple {
            background-color: #7c3aed;
            color: #ffffff;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 20px;
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
            padding: 6px 18px;
            transition: all 0.3s ease;
        }


        .btn-outline-purple:hover {
            background-color: #7c3aed;
            color: #ffffff;
        }


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


        .pet-avatar {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
        }

    </style>

</head>


<body>


    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg sticky-top">

        <div class="container">


            <!-- Logo -->

            <a
                class="navbar-brand"
                href="{{ route('pets.index') }}"
            >

                <i class="fa-solid fa-paw text-purple"></i>

                pawpals

            </a>


            <!-- Mobile Menu Button -->

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >

                <span class="navbar-toggler-icon"></span>

            </button>


            <div
                class="collapse navbar-collapse"
                id="navbarNav"
            >


                <!-- Menu Links -->

                <ul class="navbar-nav mx-auto">


                    <!-- Home -->

                    <li class="nav-item">

                        @auth

                            <a
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}"
                            >

                                Home

                            </a>

                        @else

                            <a
                                class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}"
                                href="{{ route('welcome') }}"
                            >

                                Home

                            </a>

                        @endauth

                    </li>


                    <!-- Adopt -->

                    @auth

                        <li class="nav-item">

                            <a
                                class="nav-link {{ request()->routeIs('adoption.create') ? 'active' : '' }}"
                                href="{{ route('adoption.create') }}"
                            >

                                Adopt

                            </a>

                        </li>

                    @endauth


                    <!-- Pet Care -->

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('pet-care') ? 'active' : '' }}"
                            href="{{ route('pet-care') }}"
                        >

                            Pet Care

                        </a>

                    </li>


                    <!-- About Us -->

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('about-us') ? 'active' : '' }}"
                            href="{{ route('about-us') }}"
                        >

                            About Us

                        </a>

                    </li>


                    <!-- Admin -->

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <li class="nav-item">

                                <a
                                    class="nav-link {{ request()->routeIs('admin.adoptions.*') ? 'active' : '' }}"
                                    href="{{ route('admin.adoptions.index') }}"
                                >

                                    <i class="fa-solid fa-user-shield me-1"></i>

                                    Admin

                                </a>

                            </li>

                        @endif

                    @endauth


                    <!-- Contact -->

                    <li class="nav-item">

                        <a
                            class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}"
                        >

                            Contact

                        </a>

                    </li>


                </ul>


                <!-- Auth / Action Area -->

                <div class="d-flex align-items-center gap-2">


                    <!-- Add Pet -->

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <a
                                href="{{ route('pets.create') }}"
                                class="btn btn-purple me-2"
                            >

                                <i class="fa-solid fa-plus me-1"></i>

                                Add Pet

                            </a>

                        @endif

                    @endauth


                    <!-- Guest -->

                    @guest

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-outline-purple"
                        >

                            <i class="fa-solid fa-right-to-bracket me-1"></i>

                            Login

                        </a>


                        @if (Route::has('register'))

                            <a
                                href="{{ route('register') }}"
                                class="btn btn-purple"
                            >

                                <i class="fa-solid fa-user-plus me-1"></i>

                                Register

                            </a>

                        @endif


                    @else


                        <!-- User Dropdown -->

                        <div class="dropdown">

                            <button
                                class="btn btn-light rounded-pill dropdown-toggle px-3 py-2 fw-semibold border"
                                type="button"
                                id="userMenuDropdown"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >

                                <i class="fa-solid fa-circle-user text-purple me-1"></i>

                                {{ Auth::user()->name }}

                            </button>


                            <ul
                                class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2"
                                aria-labelledby="userMenuDropdown"
                            >

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="{{ route('profile.edit') }}"
                                    >

                                        <i class="fa-solid fa-id-card me-2"></i>

                                        Profile

                                    </a>

                                </li>


                                <li>

                                    <hr class="dropdown-divider">

                                </li>


                                <li>

                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="dropdown-item text-danger fw-semibold"
                                        >

                                            <i class="fa-solid fa-right-from-bracket me-2"></i>

                                            Logout

                                        </button>

                                    </form>

                                </li>

                            </ul>

                        </div>

                    @endguest


                </div>

            </div>

        </div>

    </nav>


    <!-- Main Content -->

    <main class="container my-5">

        @yield('content')

    </main>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>


    <!-- Chat -->

    @auth

        @include('chat.widget')

    @endauth


</body>

</html>