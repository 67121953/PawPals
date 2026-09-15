@extends('pets.layout')

@section('title', 'จัดการคำขอรับเลี้ยง - PawPals')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="fa-solid fa-user-shield me-2"></i>
                จัดการคำขอรับเลี้ยง
            </h2>

            <p class="text-muted mb-0">
                ตรวจสอบและจัดการคำขอรับเลี้ยงสัตว์
            </p>
        </div>

        <a href="{{ route('pets.index') }}"
           class="btn btn-outline-purple">

            <i class="fa-solid fa-paw me-1"></i>
            รายการสัตว์เลี้ยง

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


    {{-- Adoption List --}}
    <div class="card">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="px-4 py-3">
                                สัตว์เลี้ยง
                            </th>

                            <th>
                                ผู้ขอรับเลี้ยง
                            </th>

                            <th>
                                เบอร์โทร
                            </th>

                            <th>
                                วันที่ส่งคำขอ
                            </th>

                            <th>
                                สถานะ
                            </th>

                            <th class="text-center">
                                จัดการ
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($adoptions as $adoption)

                            <tr>

                                {{-- Pet --}}
                                <td class="px-4">

                                    <div class="d-flex align-items-center gap-3">

                                        @if($adoption->pet && $adoption->pet->image)

                                            <img src="{{ asset('storage/' . $adoption->pet->image) }}"
                                                 class="pet-avatar"
                                                 alt="{{ $adoption->pet->name }}">

                                        @else

                                            <div class="pet-avatar bg-light d-flex align-items-center justify-content-center">

                                                <i class="fa-solid fa-paw text-muted"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <div class="fw-bold">
                                                {{ $adoption->pet->name ?? 'ไม่พบข้อมูล' }}
                                            </div>

                                            @if($adoption->pet)

                                                <small class="text-muted">
                                                    {{ $adoption->pet->breed }}
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Applicant --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $adoption->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $adoption->email }}
                                    </small>

                                </td>


                                {{-- Phone --}}
                                <td>

                                    {{ $adoption->phone }}

                                </td>


                                {{-- Date --}}
                                <td>

                                    {{ $adoption->created_at->format('d/m/Y H:i') }}

                                </td>


                                {{-- Status --}}
                                <td>

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

                                    @else

                                        <span class="badge bg-secondary rounded-pill px-3 py-2">

                                            ไม่ทราบสถานะ

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-center">

                                    <a href="{{ route('admin.adoptions.show', $adoption) }}"
                                       class="btn btn-sm btn-outline-purple rounded-pill px-3">

                                        <i class="fa-solid fa-eye me-1"></i>
                                        ดูรายละเอียด

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>

                                    <h5 class="text-muted">
                                        ยังไม่มีคำขอรับเลี้ยง
                                    </h5>

                                    <p class="text-muted mb-0">
                                        เมื่อมีผู้ส่งคำขอ ข้อมูลจะแสดงที่หน้านี้
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Pagination --}}
    @if($adoptions->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $adoptions->links() }}

        </div>

    @endif

</div>

@endsection