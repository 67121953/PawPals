@extends('pets.layout')

@section('title', 'ยืนยันคำขอรับเลี้ยง - PawPals')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <div class="card-body p-5 text-center">

                    <div class="mb-4">

                        <div
                            class="mx-auto d-flex align-items-center justify-content-center rounded-circle"
                            style="width: 90px; height: 90px; background-color: #e8f7ee;"
                        >

                            <i
                                class="fa-solid fa-check"
                                style="font-size: 45px; color: #28a745;"
                            ></i>

                        </div>

                    </div>

                    <h2 class="fw-bold mb-3">
                        ส่งคำขอรับเลี้ยงเรียบร้อยแล้ว!
                    </h2>

                    <p class="text-muted mb-4">
                        ขอบคุณที่สนใจรับเลี้ยงน้อง ๆ จาก PawPals
                        <br>
                        เจ้าหน้าที่จะตรวจสอบคำขอของคุณต่อไป
                    </p>

                    <div class="card border-0 bg-light rounded-4 text-start mb-4">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-4">
                                <i class="fa-solid fa-file-circle-check me-2"></i>
                                รายละเอียดคำขอ
                            </h5>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    สัตว์ที่ขอรับเลี้ยง
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->pet->name ?? '-' }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    ชื่อผู้ขอ
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->name }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    เบอร์โทรศัพท์
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->phone }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    Email
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->email }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    ที่อยู่
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->address }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    อาชีพ
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->occupation ?: '-' }}
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-4 fw-bold">
                                    ประสบการณ์เลี้ยงสัตว์
                                </div>

                                <div class="col-sm-8">

                                    @if($adoption->experience === 'yes')

                                        มีประสบการณ์

                                    @else

                                        ไม่มีประสบการณ์

                                    @endif

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 fw-bold">
                                    เหตุผลในการรับเลี้ยง
                                </div>

                                <div class="col-sm-8">
                                    {{ $adoption->reason }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="alert alert-warning rounded-4 text-start">

                        <i class="fa-solid fa-clock me-2"></i>

                        <strong>สถานะคำขอ:</strong>

                        อยู่ระหว่างการตรวจสอบ

                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-4">

                        <a
                            href="{{ route('pets.index') }}"
                            class="btn btn-primary px-4 rounded-pill"
                        >
                            <i class="fa-solid fa-paw me-2"></i>
                            กลับหน้าสัตว์เลี้ยง
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection