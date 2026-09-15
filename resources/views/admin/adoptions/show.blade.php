@extends('pets.layout')

@section('title', 'รายละเอียดคำขอรับเลี้ยง - PawPals')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="fa-solid fa-file-lines me-2"></i>
                รายละเอียดคำขอรับเลี้ยง
            </h2>

            <p class="text-muted mb-0">
                ตรวจสอบข้อมูลผู้ขอรับเลี้ยงก่อนดำเนินการ
            </p>
        </div>

        <a href="{{ route('admin.adoptions.index') }}"
           class="btn btn-outline-purple">

            <i class="fa-solid fa-arrow-left me-1"></i>
            กลับรายการ

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show rounded-4">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="row g-4">


        {{-- Pet Information --}}
        <div class="col-lg-5">

            <div class="card h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        <i class="fa-solid fa-paw me-2"></i>
                        ข้อมูลสัตว์เลี้ยง
                    </h4>


                    @if($adoption->pet)

                        {{-- Pet Image --}}
                        @if($adoption->pet->image)

                            <img src="{{ asset('storage/' . $adoption->pet->image) }}"
                                 alt="{{ $adoption->pet->name }}"
                                 class="w-100 rounded-4 mb-4"
                                 style="height: 280px; object-fit: cover;">

                        @else

                            <div class="w-100 rounded-4 mb-4 bg-light d-flex align-items-center justify-content-center"
                                 style="height: 280px;">

                                <i class="fa-solid fa-paw fa-4x text-muted"></i>

                            </div>

                        @endif


                        <h3 class="fw-bold">
                            {{ $adoption->pet->name }}
                        </h3>


                        @if($adoption->pet->breed)

                            <p class="text-muted mb-2">
                                <i class="fa-solid fa-dna me-2"></i>
                                {{ $adoption->pet->breed }}
                            </p>

                        @endif


                        <p class="text-muted mb-2">

                            <i class="fa-solid fa-venus-mars me-2"></i>

                            {{ $adoption->pet->gender }}

                        </p>


                        <p class="text-muted mb-2">

                            <i class="fa-solid fa-cake-candles me-2"></i>

                            อายุ {{ $adoption->pet->formatted_age }}

                        </p>


                        <p class="text-muted mb-3">

                            <i class="fa-solid fa-location-dot me-2"></i>

                            {{ $adoption->pet->location }}

                        </p>


                        {{-- Pet Status --}}
                        <div>

                            <strong>
                                สถานะสัตว์เลี้ยง:
                            </strong>


                            @if($adoption->pet->adoption_status === 'available')

                                <span class="badge bg-success rounded-pill ms-2">
                                    ยังไม่มีบ้าน
                                </span>

                            @elseif($adoption->pet->adoption_status === 'pending')

                                <span class="badge bg-warning text-dark rounded-pill ms-2">
                                    อยู่ระหว่างการรับเลี้ยง
                                </span>

                            @elseif($adoption->pet->adoption_status === 'adopted')

                                <span class="badge bg-secondary rounded-pill ms-2">
                                    ได้บ้านแล้ว
                                </span>

                            @endif

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>

                            <p class="text-muted mb-0">
                                ไม่พบข้อมูลสัตว์เลี้ยง
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Applicant Information --}}
        <div class="col-lg-7">

            <div class="card">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        <i class="fa-solid fa-user me-2"></i>
                        ข้อมูลผู้ขอรับเลี้ยง
                    </h4>


                    {{-- Name --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            ชื่อ - นามสกุล
                        </label>

                        <div class="fs-5">
                            {{ $adoption->name }}
                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            เบอร์โทรศัพท์
                        </label>

                        <div class="fs-5">
                            {{ $adoption->phone }}
                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            อีเมล
                        </label>

                        <div class="fs-5">
                            {{ $adoption->email }}
                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            ที่อยู่
                        </label>

                        <div class="p-3 bg-light rounded-3">
                            {{ $adoption->address }}
                        </div>

                    </div>


                    {{-- Occupation --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            อาชีพ
                        </label>

                        <div class="fs-5">

                            {{ $adoption->occupation ?: 'ไม่ได้ระบุ' }}

                        </div>

                    </div>


                    {{-- Experience --}}
                    <div class="mb-3">

                        <label class="fw-semibold text-muted">
                            มีประสบการณ์เลี้ยงสัตว์หรือไม่
                        </label>

                        <div>

                            @if($adoption->experience === 'yes')

                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="fa-solid fa-check me-1"></i>
                                    มีประสบการณ์
                                </span>

                            @else

                                <span class="badge bg-secondary rounded-pill px-3 py-2">
                                    <i class="fa-solid fa-minus me-1"></i>
                                    ไม่มีประสบการณ์
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Reason --}}
                    <div class="mb-4">

                        <label class="fw-semibold text-muted">
                            เหตุผลที่ต้องการรับเลี้ยง
                        </label>

                        <div class="p-3 bg-light rounded-3">

                            {{ $adoption->reason }}

                        </div>

                    </div>


                    {{-- Request Status --}}
                    <div class="mb-4">

                        <label class="fw-semibold text-muted">
                            สถานะคำขอ
                        </label>

                        <div class="mt-1">

                            @if($adoption->status === 'pending')

                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                    <i class="fa-solid fa-clock me-1"></i>
                                    รอตรวจสอบ

                                </span>

                            @elseif($adoption->status === 'approved')

                                <span class="badge bg-success rounded-pill px-3 py-2">

                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    อนุมัติแล้ว

                                </span>

                            @elseif($adoption->status === 'rejected')

                                <span class="badge bg-danger rounded-pill px-3 py-2">

                                    <i class="fa-solid fa-circle-xmark me-1"></i>
                                    ปฏิเสธแล้ว

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Action Buttons --}}
                    @if($adoption->status === 'pending')

                        <div class="border-top pt-4">

                            <h5 class="fw-bold mb-3">
                                ดำเนินการคำขอ
                            </h5>


                            <div class="d-flex gap-2 flex-wrap">


                                {{-- Approve --}}
                                <form action="{{ route('admin.adoptions.approve', $adoption) }}"
                                      method="POST"
                                      onsubmit="return confirm('ยืนยันการอนุมัติคำขอรับเลี้ยงนี้หรือไม่?');">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="btn btn-success rounded-pill px-4">

                                        <i class="fa-solid fa-check me-1"></i>
                                        อนุมัติการรับเลี้ยง

                                    </button>

                                </form>


                                {{-- Reject --}}
                                <form action="{{ route('admin.adoptions.reject', $adoption) }}"
                                      method="POST"
                                      onsubmit="return confirm('ยืนยันการปฏิเสธคำขอรับเลี้ยงนี้หรือไม่?');">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-4">

                                        <i class="fa-solid fa-xmark me-1"></i>
                                        ปฏิเสธคำขอ

                                    </button>

                                </form>

                            </div>

                        </div>

                    @elseif($adoption->status === 'approved')

                        <div class="alert alert-success rounded-4 mb-0">

                            <i class="fa-solid fa-circle-check me-2"></i>

                            คำขอนี้ได้รับการอนุมัติแล้ว
                            สัตว์เลี้ยงได้รับสถานะ
                            <strong>ได้บ้านแล้ว</strong>

                        </div>

                    @elseif($adoption->status === 'rejected')

                        <div class="alert alert-danger rounded-4 mb-0">

                            <i class="fa-solid fa-circle-xmark me-2"></i>

                            คำขอนี้ถูกปฏิเสธแล้ว
                            สัตว์เลี้ยงสามารถกลับมาหาบ้านใหม่ได้

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection