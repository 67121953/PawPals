@extends('pets.layout')

@section('title', $pet->name . ' - PawPals')

@section('content')

<style>
    .pet-detail-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .pet-detail-img-container {
        min-height: 380px;
        max-height: 500px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc;
    }

    .pet-detail-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .status-badge-detail {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 2;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .info-label {
        font-size: 0.85rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
    }

    .info-box {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 12px 16px;
    }

    .trait-tag {
        background-color: #f3e8ff;
        color: #7c3aed;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-right: 6px;
        margin-bottom: 8px;
    }

    /* =========================
       ADOPT BUTTON
    ========================= */
    .adopt-detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        width: 100%;
        padding: 14px 24px;

        border: none;
        border-radius: 50px;

        background: #7c3aed;
        color: white;

        font-size: 1rem;
        font-weight: 700;

        text-decoration: none;

        transition: all 0.25s ease;
        box-shadow: 0 8px 18px rgba(124, 58, 237, 0.20);
    }

    .adopt-detail-btn:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(124, 58, 237, 0.30);
    }

    .adopt-disabled-btn {
        width: 100%;
        padding: 14px 24px;
        border-radius: 50px;
        font-weight: 700;
    }

    .vaccinated-highlight {
        background: #ecfdf5;
        color: #059669;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-block;
        margin-right: 6px;
        margin-bottom: 8px;
    }

    @media (max-width: 768px) {
        .pet-detail-img-container {
            min-height: 320px;
        }
    }
</style>

<div class="container my-4">

    {{-- ปุ่มย้อนกลับ --}}
    <div class="mb-4">
        <a href="{{ route('pets.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4">

            <i class="fa-solid fa-arrow-left me-2"></i>
            ย้อนกลับ

        </a>
    </div>

    @php
        $status = $pet->adoption_status ?? 'available';

        $ageVal = (float) ($pet->age_years ?? 0);

        if ($ageVal < 1) {
            $months = round($ageVal * 12);
            $ageText = ($months > 0 ? $months : 1) . ' เดือน';
        } else {
            $years = floor($ageVal);
            $ageText = $years . ' ปี';
        }
    @endphp

    <div class="card pet-detail-card">

        <div class="row g-0">

            {{-- =====================================================
                 รูปภาพ
            ====================================================== --}}
            <div class="col-lg-6">

                <div class="pet-detail-img-container h-100">

                    {{-- Badge สถานะ --}}
                    @if($status === 'adopted')

                        <span class="badge bg-secondary status-badge-detail">
                            <i class="fa-solid fa-house-chimney-user me-1"></i>
                            ได้บ้านแล้ว
                        </span>

                    @elseif($status === 'pending')

                        <span class="badge bg-warning text-dark status-badge-detail">
                            <i class="fa-solid fa-clock me-1"></i>
                            อยู่ระหว่างการรับเลี้ยง
                        </span>

                    @else

                        <span class="badge bg-success status-badge-detail">
                            <i class="fa-solid fa-heart me-1"></i>
                            ยังไม่มีบ้าน
                        </span>

                    @endif


                    {{-- รูปสัตว์ --}}
                    @if(!empty($pet->image))

                        <img src="{{ asset('storage/' . $pet->image) }}"
                             alt="{{ $pet->name }}"
                             style="{{ $status === 'adopted'
                                ? 'filter: grayscale(35%);'
                                : '' }}">

                    @else

                        <div class="text-secondary text-center py-5">

                            <i class="fa-solid fa-paw fa-5x mb-3 opacity-25"></i>

                            <div class="fs-5">
                                No Image Available
                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 รายละเอียด
            ====================================================== --}}
            <div class="col-lg-6 p-4 p-md-5">

                {{-- ชื่อและประเภท --}}
                <div class="d-flex justify-content-between align-items-start mb-2">

                    <h1 class="fw-bold text-dark display-6 mb-0">
                        {{ $pet->name }}
                    </h1>

                    @if(!empty($pet->type))

                        <span class="badge fs-6 px-3 py-2 rounded-pill"
                              style="background-color: #f3e8ff; color: #7c3aed;">

                            {{ $pet->type }}

                        </span>

                    @endif

                </div>


                {{-- สายพันธุ์ --}}
                @if(!empty($pet->breed))

                    <p class="text-muted fs-5 mb-4">

                        <i class="fa-solid fa-paw me-2"
                           style="color: #7c3aed;"></i>

                        {{ $pet->breed }}

                    </p>

                @endif


                <hr class="my-4 text-muted opacity-25">


                {{-- =====================================================
                     ข้อมูลสำคัญ
                ====================================================== --}}
                <div class="row g-3 mb-4">

                    {{-- เพศ --}}
                    <div class="col-6">

                        <div class="info-box">

                            <div class="info-label">
                                เพศ (Gender)
                            </div>

                            <div class="info-value">

                                <i class="{{ strtolower($pet->gender) == 'female'
                                    ? 'fa-solid fa-venus text-danger'
                                    : 'fa-solid fa-mars text-primary' }} me-1">
                                </i>

                                {{ strtolower($pet->gender) == 'female'
                                    ? 'เพศเมีย'
                                    : 'เพศผู้' }}

                            </div>

                        </div>

                    </div>


                    {{-- อายุ --}}
                    <div class="col-6">

                        <div class="info-box">

                            <div class="info-label">
                                อายุ (Age)
                            </div>

                            <div class="info-value">

                                <i class="fa-regular fa-clock text-warning me-1"></i>

                                {{ $ageText }}

                            </div>

                        </div>

                    </div>


                    {{-- สถานที่ --}}
                    @if(!empty($pet->location))

                        <div class="col-12">

                            <div class="info-box">

                                <div class="info-label">
                                    สถานที่ (Location)
                                </div>

                                <div class="info-value">

                                    <i class="fa-solid fa-location-dot text-danger me-1"></i>

                                    {{ $pet->location }}

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- =====================================================
                     คำอธิบาย
                ====================================================== --}}
                @if(!empty($pet->about))

                    <div class="mb-4">

                        <h5 class="fw-bold text-dark mb-2">
                            เกี่ยวกับ {{ $pet->name }}
                        </h5>

                        <p class="text-secondary mb-0"
                           style="line-height: 1.7;">

                            {{ $pet->about }}

                        </p>

                    </div>

                @endif


                {{-- =====================================================
                     คุณลักษณะ / วัคซีน
                ====================================================== --}}
                <div class="mt-3">

                    {{-- ฉีดวัคซีนแล้ว --}}
                    @if($pet->is_vaccinated)

                        <span class="vaccinated-highlight">

                            <i class="fa-solid fa-syringe me-1"></i>

                            ฉีดวัคซีนแล้ว

                        </span>

                    @else

                        <span class="trait-tag"
                              style="background-color: #fff7ed; color: #ea580c;">

                            <i class="fa-solid fa-syringe me-1"></i>

                            ยังไม่ได้ฉีดวัคซีน

                        </span>

                    @endif


                    {{-- สุขภาพดี --}}
                    @if($pet->is_healthy)

                        <span class="trait-tag">

                            <i class="fa-solid fa-heart-pulse me-1"></i>

                            สุขภาพดี

                        </span>

                    @endif


                    {{-- ขับถ่ายเป็นที่ --}}
                    @if($pet->is_potty_trained)

                        <span class="trait-tag">

                            <i class="fa-solid fa-check me-1"></i>

                            ขับถ่ายเป็นที่

                        </span>

                    @endif


                    {{-- เข้ากับคนง่าย --}}
                    @if($pet->is_people_friendly)

                        <span class="trait-tag">

                            <i class="fa-solid fa-users me-1"></i>

                            เข้ากับคนง่าย

                        </span>

                    @endif

                </div>


                {{-- =====================================================
                     ปุ่มรับไปเลี้ยง
                     อยู่ด้านล่างข้อมูลวัคซีน
                ====================================================== --}}
                <div class="mt-4 pt-3 border-top">

                    @if($status === 'available')

                        @auth

                            <a href="{{ route('adoption.create', ['pet_id' => $pet->id]) }}"
                               class="adopt-detail-btn">

                                <i class="fa-solid fa-paw"></i>

                                รับ {{ $pet->name }} ไปเลี้ยง

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        @else

                            <a href="{{ route('login') }}"
                               class="adopt-detail-btn">

                                <i class="fa-solid fa-right-to-bracket"></i>

                                เข้าสู่ระบบเพื่อรับไปเลี้ยง

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        @endauth

                    @elseif($status === 'pending')

                        <button type="button"
                                class="btn btn-warning adopt-disabled-btn"
                                disabled>

                            <i class="fa-solid fa-clock me-1"></i>

                            อยู่ระหว่างการรับเลี้ยง

                        </button>

                    @else

                        <button type="button"
                                class="btn btn-outline-secondary adopt-disabled-btn"
                                disabled>

                            <i class="fa-solid fa-house-chimney-user me-1"></i>

                            {{ $pet->name }} ได้บ้านแล้ว

                        </button>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection