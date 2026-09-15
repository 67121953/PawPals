@extends('pets.layout')

@section('title', 'แบบฟอร์มขอรับเลี้ยง - PawPals')

@section('content')

<style>
    .adoption-card {
        border: none;
        border-radius: 20px;
        background-color: #ffffff;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 10px 16px;
        border: 1px solid #cbd5e1;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.15);
    }

    .btn-submit-adoption {
        background-color: #8b5cf6;
        color: #ffffff;
        font-weight: 600;
        border-radius: 50px;
        padding: 10px 24px;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-submit-adoption:hover {
        background-color: #7c3aed;
        color: #ffffff;
    }

    .btn-cancel {
        border-radius: 50px;
        padding: 10px 24px;
        font-weight: 600;
    }
</style>

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card adoption-card shadow-sm p-4 p-md-5">

                <div class="text-center mb-4">

                    <h3 class="fw-bold text-dark">
                        🐾 แบบฟอร์มขอรับเลี้ยงน้องหมา–น้องแมว
                    </h3>

                    <p class="text-muted">
                        กรอกข้อมูลเพื่อให้เจ้าหน้าที่ติดต่อกลับเพื่อพิจารณาการรับเลี้ยง
                    </p>

                </div>

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>กรุณาตรวจสอบข้อมูล</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('adoption.store') }}" method="POST">

                    @csrf


                    <!-- เลือกสัตว์ที่ต้องการรับเลี้ยง -->

                    <div class="mb-3">

                        <label for="pet_id" class="form-label">

                            น้องที่ต้องการรับเลี้ยง

                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="pet_id"
                            id="pet_id"
                            class="form-select @error('pet_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- เลือกน้องหมา / น้องแมว --
                            </option>

                            @foreach ($pets as $pet)

                                <option
                                    value="{{ $pet->id }}"
                                    {{ old('pet_id', request('pet_id')) == $pet->id ? 'selected' : '' }}
                                >
                                    {{ $pet->name }}
                                    ({{ $pet->type ?? 'สัตว์เลี้ยง' }})
                                </option>

                            @endforeach

                        </select>

                        @error('pet_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="row g-3">


                        <!-- ชื่อ -->

                        <div class="col-md-6 mb-3">

                            <label for="name" class="form-label">

                                ชื่อ - นามสกุล

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="เช่น สมชาย ใจดี"
                                required
                            >

                            @error('name')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- เบอร์โทร -->

                        <div class="col-md-6 mb-3">

                            <label for="phone" class="form-label">

                                เบอร์โทรศัพท์

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"
                                placeholder="เช่น 0812345678"
                                required
                            >

                            @error('phone')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <div class="row g-3">


                        <!-- Email -->

                        <div class="col-md-6 mb-3">

                            <label for="email" class="form-label">

                                อีเมล

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="example@email.com"
                                required
                            >

                            @error('email')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- อาชีพ -->

                        <div class="col-md-6 mb-3">

                            <label for="occupation" class="form-label">

                                อาชีพ

                            </label>

                            <input
                                type="text"
                                name="occupation"
                                id="occupation"
                                class="form-control @error('occupation') is-invalid @enderror"
                                value="{{ old('occupation') }}"
                                placeholder="เช่น พนักงานบริษัท, ธุรกิจส่วนตัว"
                            >

                            @error('occupation')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <!-- ที่อยู่ -->

                    <div class="mb-3">

                        <label for="address" class="form-label">

                            ที่อยู่ปัจจุบัน

                            <span class="text-danger">*</span>

                        </label>

                        <textarea
                            name="address"
                            id="address"
                            class="form-control @error('address') is-invalid @enderror"
                            rows="3"
                            placeholder="กรุณาระบุที่อยู่โดยละเอียด..."
                            required
                        >{{ old('address') }}</textarea>

                        @error('address')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- ประสบการณ์เลี้ยงสัตว์ -->

                    <div class="mb-3">

                        <label for="experience" class="form-label">

                            เคยเลี้ยงสัตว์มาก่อนหรือไม่?

                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="experience"
                            id="experience"
                            class="form-select @error('experience') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- เลือกประสบการณ์ --
                            </option>

                            <option
                                value="yes"
                                {{ old('experience') == 'yes' ? 'selected' : '' }}
                            >
                                เคยเลี้ยง
                            </option>

                            <option
                                value="no"
                                {{ old('experience') == 'no' ? 'selected' : '' }}
                            >
                                ไม่เคยเลี้ยง
                            </option>

                        </select>

                        @error('experience')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- เหตุผล -->

                    <div class="mb-4">

                        <label for="reason" class="form-label">

                            เหตุผลที่ต้องการรับเลี้ยง

                            <span class="text-danger">*</span>

                        </label>

                        <textarea
                            name="reason"
                            id="reason"
                            class="form-control @error('reason') is-invalid @enderror"
                            rows="4"
                            placeholder="อธิบายเหตุผลและสภาพแวดล้อมบ้านของคุณเบื้องต้น..."
                            required
                        >{{ old('reason') }}</textarea>

                        @error('reason')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- ปุ่ม -->

                    <div class="d-flex justify-content-end gap-2 pt-2">

                        <a
                            href="{{ route('pets.index') }}"
                            class="btn btn-light border btn-cancel"
                        >
                            ยกเลิก
                        </a>

                        <button
                            type="submit"
                            class="btn btn-submit-adoption shadow-sm"
                        >
                            ❤️ ส่งคำขอรับเลี้ยง
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection