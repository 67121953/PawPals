@extends('pets.layout')

@section('title', 'จัดการคำขอรับเลี้ยง - PawPals')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="fa-solid fa-user-shield me-2"></i>
                จัดการคำขอรับเลี้ยง
            </h2>

            <p class="text-muted mb-0">
                ตรวจสอบและจัดการคำขอรับเลี้ยงสัตว์เลี้ยง
            </p>
        </div>

        <a href="{{ route('pets.index') }}"
           class="btn btn-outline-purple">
            <i class="fa-solid fa-paw me-1"></i>
            รายการสัตว์เลี้ยง
        </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"
             role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="px-4 py-3">
                                สัตว์เลี้ยง
                            </th>

                            <th class="py-3">
                                ผู้ขอรับเลี้ยง
                            </th>

                            <th class="py-3">
                                เบอร์โทร
                            </th>

                            <th class="py-3">
                                วันที่ส่งคำขอ
                            </th>

                            <th class="py-3">
                                สถานะ
                            </th>

                            <th class="py-3 text-center">
                                จัดการ
                            </th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($adoptions as $adoption)

                            <tr>

                                {{-- สัตว์เลี้ยง --}}
                                <td class="px-4">

                                    <div class="d-flex align-items-center">

                                        @if($adoption->pet && $adoption->pet->image)

                                            <img src="{{ asset('storage/' . $adoption->pet->image) }}"
                                                 alt="{{ $adoption->pet->name }}"
                                                 class="pet-avatar me-3">

                                        @else

                                            <div class="pet-avatar bg-light d-flex align-items-center justify-content-center me-3">
                                                <i class="fa-solid fa-paw text-muted"></i>
                                            </div>

                                        @endif


                                        <div>

                                            @if($adoption->pet)

                                                <div class="fw-bold">
                                                    {{ $adoption->pet->name }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $adoption->pet->breed }}
                                                </small>

                                            @else

                                                <div class="text-danger">
                                                    ไม่พบข้อมูลสัตว์เลี้ยง
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- ผู้ขอรับเลี้ยง --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $adoption->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $adoption->email }}
                                    </small>

                                </td>


                                {{-- เบอร์โทร --}}
                                <td>
                                    {{ $adoption->phone }}
                                </td>


                                {{-- วันที่ --}}
                                <td>
                                    {{ $adoption->created_at->format('d/m/Y H:i') }}
                                </td>


                                {{-- สถานะ --}}
                                <td>

                                    @if($adoption->status === 'approved')

                                        <span class="badge bg-success">
                                            <i class="fa-solid fa-check me-1"></i>
                                            อนุมัติแล้ว
                                        </span>

                                    @elseif($adoption->status === 'rejected')

                                        <span class="badge bg-danger">
                                            <i class="fa-solid fa-xmark me-1"></i>
                                            ปฏิเสธแล้ว
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            <i class="fa-solid fa-clock me-1"></i>
                                            รอตรวจสอบ
                                        </span>

                                    @endif

                                </td>


                                {{-- ปุ่มจัดการ --}}
                                <td class="text-center">

                                    <a href="{{ route('admin.adoptions.show', $adoption) }}"
                                       class="btn btn-sm btn-purple">

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
                                        เมื่อมีผู้ส่งคำขอรับเลี้ยง
                                        รายการจะแสดงที่หน้านี้
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