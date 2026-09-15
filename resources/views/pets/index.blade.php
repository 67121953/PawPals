@extends('pets.layout')

@section('title', 'Adoptable Pets - PawPals')

@section('content')

<style>
    body {
        background: #f8fafc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* =========================
       HERO
    ========================= */
    .pets-hero {
        position: relative;
        overflow: hidden;
        min-height: 400px;

        background:
            linear-gradient(
                90deg,
                rgba(255, 247, 237, 0.97) 0%,
                rgba(255, 247, 237, 0.88) 25%,
                rgba(255, 247, 237, 0.55) 48%,
                rgba(255, 247, 237, 0.18) 72%,
                rgba(255, 247, 237, 0.05) 100%
            ),
            url('https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=1800&q=90');

        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;

        display: flex;
        align-items: center;
    }

    .pets-hero-content {
        max-width: 720px;
        padding: 60px 0;
        position: relative;
        z-index: 2;
    }

    .pets-hero-title {
        font-size: 3.8rem;
        font-weight: 800;
        line-height: 1.1;
        color: #1e293b;
        margin-bottom: 0;
    }

    .pets-hero-title span {
        color: #f97316;
    }

    .pets-hero-text {
        margin-top: 20px;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #64748b;
        max-width: 650px;
    }

    .pets-hero-label {
        color: #f59e0b;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 12px;
    }

    /* =========================
       MAIN
    ========================= */
    .pets-main {
        padding: 45px 0 70px;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .see-all {
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .see-all:hover {
        color: #f97316;
    }

    /* =========================
       FILTER
    ========================= */
    .filter-box {
        background: white;
        border-radius: 18px;
        padding: 5px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 5px 18px rgba(15, 23, 42, 0.04);
    }

    .filter-box .form-control,
    .filter-box .form-select {
        border: none !important;
        box-shadow: none !important;
        min-height: 48px;
        color: #475569;
    }

    .filter-box .input-group-text {
        border: none;
        background: white;
        color: #64748b;
    }

    .btn-search {
        min-height: 48px;
        border: none;
        border-radius: 50px;
        background: #7c3aed;
        color: white;
        font-weight: 700;
        width: 100%;
        transition: all 0.25s ease;
    }

    .btn-search:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(124, 58, 237, 0.25);
    }

    /* =========================
       PET CARD
    ========================= */
    .pet-card {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
    }

    .pet-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
    }

    /* =========================
       PET IMAGE
    ========================= */
    .pet-img-container {
        height: 245px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff7ed;
    }

    .pet-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .pet-card:hover .pet-img-container img {
        transform: scale(1.06);
    }

    .pet-image-link {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
    }

    .pet-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 85px;

        background:
            linear-gradient(
                135deg,
                #fff7ed,
                #ffedd5
            );
    }

    /* =========================
       STATUS
    ========================= */
    .status-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 5;

        font-size: 0.75rem;
        font-weight: 700;
        padding: 7px 13px;
        border-radius: 50px;

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }

    .type-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        z-index: 5;

        background: rgba(255, 255, 255, 0.94);
        color: #f97316;

        font-size: 0.75rem;
        font-weight: 700;

        padding: 6px 12px;
        border-radius: 50px;

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* =========================
       ADMIN ACTION
    ========================= */
    .action-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        gap: 6px;
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 10;
    }

    .pet-card:hover .action-overlay {
        opacity: 1;
    }

    /* =========================
       PET INFO
    ========================= */
    .pet-info-box {
        background: #ffffff;
        padding: 18px;
    }

    .pet-name {
        font-weight: 800;
        font-size: 1.15rem;
        color: #1e293b;
        margin-bottom: 7px;
    }

    .pet-breed {
        font-size: 0.88rem;
        color: #64748b;
        margin-bottom: 9px;
    }

    .pet-meta {
        font-size: 0.85rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .pet-location {
        font-size: 0.82rem;
        color: #94a3b8;
        margin-bottom: 14px;
    }

    /* =========================
       ADOPT BUTTON
    ========================= */
    .btn-adopt-toggle {
        font-size: 0.88rem;
        font-weight: 700;
        border-radius: 50px;
        padding: 9px 14px;
        width: 100%;
        transition: all 0.25s ease;
    }

    .btn-purple {
        background: #7c3aed;
        border-color: #7c3aed;
        color: white;
    }

    .btn-purple:hover {
        background: #6d28d9;
        border-color: #6d28d9;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(124, 58, 237, 0.25);
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .empty-wrapper {
        width: 100%;
        min-height: 280px;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .empty-box {
        width: 100%;
        max-width: 500px;
        min-height: 230px;

        padding: 50px 25px;
        margin: 0 auto;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        text-align: center;

        background: #ffffff;
        border-radius: 25px;

        box-shadow: 0 5px 18px rgba(15, 23, 42, 0.05);
    }

    .empty-box i {
        display: block;
        margin-bottom: 15px;
    }

    .empty-box p {
        text-align: center;
        margin: 0;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 992px) {

        .pets-hero {
            min-height: 380px;
            background-position: center center;
        }

        .pets-hero-title {
            font-size: 3.2rem;
        }
    }

    @media (max-width: 768px) {

        .pets-hero {
            min-height: 400px;
            background-position: 60% center;
        }

        .pets-hero-content {
            padding: 45px 20px;
        }

        .pets-hero-title {
            font-size: 2.5rem;
        }

        .pets-hero-text {
            font-size: 1rem;
        }

        .action-overlay {
            opacity: 1;
        }

        .empty-wrapper {
            min-height: 250px;
        }

        .empty-box {
            max-width: 90%;
        }
    }
</style>


{{-- =====================================================
     HERO
===================================================== --}}
<section class="pets-hero">

    <div class="container">

        <div class="pets-hero-content">

            <div class="pets-hero-label">
                🐾 PAWPALS
            </div>

            <h1 class="pets-hero-title">
                Adoptable
                <span>Pets</span>
            </h1>

            <p class="pets-hero-text">
                เพื่อนตัวน้อยกำลังรอบ้านใหม่
                มาเปิดโอกาสให้พวกเขาได้พบกับครอบครัวที่อบอุ่น
                และเริ่มต้นชีวิตใหม่ไปด้วยกัน
            </p>

        </div>

    </div>

</section>


{{-- =====================================================
     MAIN
===================================================== --}}
<div class="pets-main">

    <div class="container">

        {{-- Alert Success --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4"
                 role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

        @endif


        {{-- Alert Error --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4"
                 role="alert">

                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

        @endif


        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="section-title m-0">
                Adoptable Pets
            </h2>

            <a href="{{ route('pets.index') }}"
               class="see-all">
                See All →
            </a>

        </div>


        {{-- =================================================
             FILTER
        ================================================= --}}
        <form action="{{ route('pets.index') }}"
              method="GET"
              class="mb-5">

            <div class="row g-2 align-items-center filter-box">

                {{-- Search --}}
                <div class="col-lg-4">

                    <div class="input-group">

                        <span class="input-group-text rounded-start-pill ps-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-end-pill"
                               placeholder="Search for Pets...">

                    </div>

                </div>


                {{-- Type --}}
                <div class="col-lg-2 col-md-4">

                    <select name="type"
                            class="form-select rounded-pill"
                            onchange="this.form.submit()">

                        <option value="">
                            Type
                        </option>

                        <option value="Dog"
                            {{ request('type') == 'Dog' ? 'selected' : '' }}>
                            🐶 Dog
                        </option>

                        <option value="Cat"
                            {{ request('type') == 'Cat' ? 'selected' : '' }}>
                            🐱 Cat
                        </option>

                    </select>

                </div>


                {{-- Age --}}
                <div class="col-lg-2 col-md-4">

                    <select name="age"
                            class="form-select rounded-pill"
                            onchange="this.form.submit()">

                        <option value="">
                            Age
                        </option>

                        <option value="young"
                            {{ request('age') == 'young' ? 'selected' : '' }}>
                            Under 1 year
                        </option>

                        <option value="adult"
                            {{ request('age') == 'adult' ? 'selected' : '' }}>
                            1 - 7 years
                        </option>

                        <option value="senior"
                            {{ request('age') == 'senior' ? 'selected' : '' }}>
                            Over 7 years
                        </option>

                    </select>

                </div>


                {{-- Status --}}
                <div class="col-lg-2 col-md-4">

                    <select name="status"
                            class="form-select rounded-pill"
                            onchange="this.form.submit()">

                        <option value="">
                            Status
                        </option>

                        <option value="available"
                            {{ request('status') == 'available' ? 'selected' : '' }}>
                            ยังไม่มีบ้าน
                        </option>

                        <option value="pending"
                            {{ request('status') == 'pending' ? 'selected' : '' }}>
                            อยู่ระหว่างการรับเลี้ยง
                        </option>

                        <option value="adopted"
                            {{ request('status') == 'adopted' ? 'selected' : '' }}>
                            ได้บ้านแล้ว
                        </option>

                    </select>

                </div>


                {{-- Search Button --}}
                <div class="col-lg-2">

                    <button type="submit"
                            class="btn btn-search">

                        <i class="fa-solid fa-magnifying-glass me-1"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>


        {{-- =================================================
             PET CARDS
        ================================================= --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

            @forelse($pets as $index => $item)

                @php

                    $status = $item->adoption_status ?? 'available';

                    $ageVal = (float) ($item->age_years ?? 0);

                    if ($ageVal < 1) {

                        $months = round($ageVal * 12);

                        $ageText =
                            ($months > 0 ? $months : 1)
                            . ' '
                            . ($months > 1 ? 'months' : 'month');

                    } else {

                        $years = floor($ageVal);

                        $ageText =
                            $years
                            . ' '
                            . ($years > 1 ? 'years' : 'year');

                    }

                    /* Pet Type */

                    $petType = strtolower($item->type ?? '');

                    /* Default Image */

                    if ($petType === 'dog') {

                        $defaultImage =
                            'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=900&q=85';

                        $typeIcon = '🐶';
                        $typeName = 'Dog';

                    } elseif ($petType === 'cat') {

                        $defaultImage =
                            'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=900&q=85';

                        $typeIcon = '🐱';
                        $typeName = 'Cat';

                    } else {

                        $defaultImage =
                            'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=900&q=85';

                        $typeIcon = '🐾';
                        $typeName = 'Pet';

                    }

                @endphp


                <div class="col">

                    <div class="card pet-card h-100">

                        {{-- =================================================
                             IMAGE
                        ================================================= --}}
                        <div class="pet-img-container">

                            {{-- Status --}}
                            @if($status === 'adopted')

                                <span class="badge bg-secondary status-badge">

                                    <i class="fa-solid fa-house-chimney-user me-1"></i>

                                    ได้บ้านแล้ว

                                </span>

                            @elseif($status === 'pending')

                                <span class="badge bg-warning text-dark status-badge">

                                    <i class="fa-solid fa-clock me-1"></i>

                                    อยู่ระหว่างการรับเลี้ยง

                                </span>

                            @else

                                <span class="badge bg-success status-badge">

                                    <i class="fa-solid fa-heart me-1"></i>

                                    ยังไม่มีบ้าน

                                </span>

                            @endif


                            {{-- PET IMAGE --}}
                            @if(!empty($item->image))

                                @auth

                                    <a href="{{ route('pets.show', $item->id) }}"
                                       class="pet-image-link">

                                        <img src="{{ asset('storage/' . $item->image) }}"
                                             alt="{{ $item->name }}"
                                             style="{{ $status === 'adopted'
                                                ? 'filter: grayscale(35%);'
                                                : '' }}">

                                    </a>

                                @else

                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         alt="{{ $item->name }}"
                                         style="{{ $status === 'adopted'
                                            ? 'filter: grayscale(35%);'
                                            : '' }}">

                                @endauth

                            @else

                                {{-- Default Image --}}
                                @auth

                                    <a href="{{ route('pets.show', $item->id) }}"
                                       class="pet-image-link">

                                        <img src="{{ $defaultImage }}"
                                             alt="{{ $item->name }}">

                                    </a>

                                @else

                                    <img src="{{ $defaultImage }}"
                                         alt="{{ $item->name }}">

                                @endauth

                            @endif


                            {{-- Type --}}
                            <span class="type-badge">

                                {{ $typeIcon }}

                                {{ $typeName }}

                            </span>


                            {{-- ADMIN ACTION --}}
                            @auth

                                @if(auth()->user()->role === 'admin')

                                    <div class="action-overlay">

                                        {{-- Edit --}}
                                        <a href="{{ route('pets.edit', $item->id) }}"
                                           class="btn btn-sm btn-light rounded-circle shadow-sm"
                                           title="Edit">

                                            <i class="fa-solid fa-pen text-dark"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('pets.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('ต้องการลบสัตว์เลี้ยงตัวนี้ใช่หรือไม่?');"
                                              class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-circle shadow-sm"
                                                    title="Delete">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                @endif

                            @endauth

                        </div>


                        {{-- =================================================
                             PET INFORMATION
                        ================================================= --}}
                        <div class="pet-info-box">

                            {{-- Name --}}
                            <div class="pet-name">
                                {{ $item->name }}
                            </div>


                            {{-- Breed --}}
                            @if(!empty($item->breed))

                                <div class="pet-breed">

                                    <i class="fa-solid fa-paw me-1"></i>

                                    {{ $item->breed }}

                                </div>

                            @endif


                            {{-- Gender + Age --}}
                            <div class="pet-meta">

                                <span>

                                    <i class="{{ strtolower($item->gender) == 'male'
                                        ? 'fa-solid fa-mars text-primary'
                                        : 'fa-solid fa-venus text-danger' }}">
                                    </i>

                                    {{ strtolower($item->gender) }}

                                </span>


                                <span>

                                    <i class="fa-regular fa-clock"></i>

                                    {{ $ageText }}

                                </span>

                            </div>


                            {{-- Location --}}
                            @if(!empty($item->location))

                                <div class="pet-location">

                                    <i class="fa-solid fa-location-dot me-1"></i>

                                    {{ $item->location }}

                                </div>

                            @endif


                            {{-- ADOPTION BUTTON --}}
                            @if($status === 'adopted')

                                <button type="button"
                                        class="btn btn-outline-secondary btn-adopt-toggle"
                                        disabled>

                                    <i class="fa-solid fa-circle-check me-1"></i>

                                    ได้บ้านแล้ว

                                </button>

                            @elseif($status === 'pending')

                                <button type="button"
                                        class="btn btn-warning btn-adopt-toggle"
                                        disabled>

                                    <i class="fa-solid fa-clock me-1"></i>

                                    อยู่ระหว่างการรับเลี้ยง

                                </button>

                            @else

                                @auth

                                    <a href="{{ route('adoption.create', ['pet_id' => $item->id]) }}"
                                       class="btn btn-purple btn-adopt-toggle text-decoration-none">

                                        <i class="fa-solid fa-paw me-1"></i>

                                        กดเพื่อรับเลี้ยง

                                    </a>

                                @else

                                    <a href="{{ route('login') }}"
                                       class="btn btn-purple btn-adopt-toggle text-decoration-none">

                                        <i class="fa-solid fa-right-to-bracket me-1"></i>

                                        เข้าสู่ระบบเพื่อรับเลี้ยง

                                    </a>

                                @endauth

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="col-12 d-flex justify-content-center">

                    <div class="empty-wrapper">

                        <div class="empty-box">

                            <i class="fa-solid fa-box-open fa-3x text-muted"></i>

                            <p class="text-muted fs-5 mb-0">
                                ยังไม่มีข้อมูลสัตว์เลี้ยงในระบบ
                            </p>

                        </div>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- =================================================
             PAGINATION
        ================================================= --}}
        @if($pets->hasPages())

            <div class="d-flex justify-content-center mt-5">

                {{ $pets->links() }}

            </div>

        @endif

    </div>

</div>

@endsection