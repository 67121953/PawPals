@extends('pets.layout')

@section('title', 'Add New Pet - PawPals')

@section('content')

<style>
    .add-pet-page {
        padding: 40px 0 70px;
        background: #f8fafc;
        min-height: calc(100vh - 80px);
    }

    .add-pet-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
    }

    .add-pet-header {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: white;
        padding: 25px 30px;
    }

    .add-pet-header h3 {
        margin: 0;
        font-weight: 800;
    }

    .add-pet-header p {
        margin: 6px 0 0;
        opacity: 0.9;
    }

    .add-pet-body {
        padding: 35px;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ea580c;
        font-weight: 800;
        margin-bottom: 22px;
    }

    .form-section-title .section-number {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff7ed;
        color: #ea580c;
        border-radius: 50%;
        font-weight: 800;
    }

    .form-label {
        font-weight: 700;
        color: #334155;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        min-height: 45px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
    }

    textarea.form-control {
        min-height: 110px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.12);
    }

    .personality-box {
        background: #fff7ed;
        border-radius: 16px;
        padding: 20px;
    }

    .personality-label {
        font-weight: 700;
        color: #475569;
    }

    .form-range {
        accent-color: #f97316;
    }

    .attribute-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 15px;
        height: 100%;
        transition: 0.2s ease;
    }

    .attribute-box:hover {
        border-color: #fdba74;
        background: #fff7ed;
    }

    .form-check-input {
        width: 19px;
        height: 19px;
        margin-top: 0.15em;
    }

    .form-check-input:checked {
        background-color: #f97316;
        border-color: #f97316;
    }

    .attribute-label {
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        margin-left: 5px;
    }

    .status-box {
        background: #f8fafc;
        border-radius: 14px;
        padding: 20px;
        border: 1px solid #e2e8f0;
    }

    .image-box {
        background: #fff7ed;
        border: 2px dashed #fdba74;
        border-radius: 16px;
        padding: 25px;
    }

    .image-box small {
        display: block;
        margin-top: 8px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-save-pet {
        background: #f97316;
        border-color: #f97316;
        color: white;
        font-weight: 700;
        border-radius: 50px;
        padding: 11px 25px;
    }

    .btn-save-pet:hover {
        background: #ea580c;
        border-color: #ea580c;
        color: white;
        transform: translateY(-1px);
    }

    .btn-back-pet {
        border-radius: 50px;
        padding: 11px 25px;
        font-weight: 700;
    }

    .required-star {
        color: #dc2626;
    }

    @media (max-width: 768px) {
        .add-pet-page {
            padding: 20px 0 40px;
        }

        .add-pet-body {
            padding: 20px;
        }

        .add-pet-header {
            padding: 20px;
        }
    }
</style>

<div class="add-pet-page">

    <div class="container">

        <div class="card add-pet-card">

            {{-- HEADER --}}
            <div class="add-pet-header">

                <h3>
                    <i class="fa-solid fa-paw me-2"></i>
                    Add New Pet
                </h3>

                <p>
                    เพิ่มข้อมูลสัตว์เลี้ยงเข้าสู่ระบบ PawPals
                </p>

            </div>


            {{-- BODY --}}
            <div class="add-pet-body">

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))

                    <div class="alert alert-success rounded-4 mb-4">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        {{ session('success') }}
                    </div>

                @endif


                {{-- ERROR MESSAGE --}}
                @if($errors->any())

                    <div class="alert alert-danger rounded-4 mb-4">

                        <strong>
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            ไม่สามารถบันทึกข้อมูลได้
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- FORM --}}
                <form action="{{ route('pets.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf


                    {{-- =====================================================
                         SECTION 1
                    ====================================================== --}}

                    <h5 class="form-section-title">

                        <span class="section-number">
                            1
                        </span>

                        ข้อมูลทั่วไป
                        <small class="text-muted">
                            (General Information)
                        </small>

                    </h5>


                    <div class="row">

                        {{-- NAME --}}
                        <div class="col-md-6 mb-3">

                            <label for="name" class="form-label">
                                Pet Name (ชื่อสัตว์เลี้ยง)
                                <span class="required-star">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control"
                                   placeholder="เช่น Charlie"
                                   value="{{ old('name') }}"
                                   required>

                        </div>


                        {{-- TYPE --}}
                        <div class="col-md-6 mb-3">

                            <label for="type" class="form-label">
                                Type (ประเภทสัตว์เลี้ยง)
                                <span class="required-star">*</span>
                            </label>

                            <select name="type"
                                    id="type"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- เลือกประเภท --
                                </option>

                                <option value="Dog"
                                    {{ old('type') === 'Dog' ? 'selected' : '' }}>
                                    🐶 หมา (Dog)
                                </option>

                                <option value="Cat"
                                    {{ old('type') === 'Cat' ? 'selected' : '' }}>
                                    🐱 แมว (Cat)
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="row">

                        {{-- AGE --}}
                        <div class="col-md-3 mb-3">

                            <label for="age" class="form-label">
                                Age (อายุ)
                                <span class="required-star">*</span>
                            </label>

                            <div class="input-group">

                                <input type="number"
                                       name="age"
                                       id="age"
                                       class="form-control"
                                       placeholder="1"
                                       min="0"
                                       step="0.1"
                                       value="{{ old('age') }}"
                                       required>

                                <select name="age_unit"
                                        id="age_unit"
                                        class="form-select"
                                        style="max-width: 110px;"
                                        required>

                                    <option value="years"
                                        {{ old('age_unit', 'years') === 'years' ? 'selected' : '' }}>
                                        ปี
                                    </option>

                                    <option value="months"
                                        {{ old('age_unit') === 'months' ? 'selected' : '' }}>
                                        เดือน
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- WEIGHT --}}
                        <div class="col-md-3 mb-3">

                            <label for="weight_lbs" class="form-label">
                                Weight (น้ำหนัก/ปอนด์)
                                <span class="required-star">*</span>
                            </label>

                            <input type="number"
                                   step="0.1"
                                   name="weight_lbs"
                                   id="weight_lbs"
                                   class="form-control"
                                   placeholder="35"
                                   min="0"
                                   value="{{ old('weight_lbs') }}"
                                   required>

                        </div>


                        {{-- BREED --}}
                        <div class="col-md-3 mb-3">

                            <label for="breed" class="form-label">
                                Breed (สายพันธุ์)
                                <span class="required-star">*</span>
                            </label>

                            <input type="text"
                                   name="breed"
                                   id="breed"
                                   class="form-control"
                                   placeholder="เช่น Retriever Mix"
                                   value="{{ old('breed') }}"
                                   required>

                        </div>


                        {{-- GENDER --}}
                        <div class="col-md-3 mb-3">

                            <label for="gender" class="form-label">
                                Gender (เพศ)
                                <span class="required-star">*</span>
                            </label>

                            <select name="gender"
                                    id="gender"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- เลือกเพศ --
                                </option>

                                <option value="Male"
                                    {{ old('gender') === 'Male' ? 'selected' : '' }}>
                                    ผู้ (Male)
                                </option>

                                <option value="Female"
                                    {{ old('gender') === 'Female' ? 'selected' : '' }}>
                                    เมีย (Female)
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- LOCATION --}}
                    <div class="mb-3">

                        <label for="location" class="form-label">
                            Location (สถานที่/ศูนย์พักพิง)
                            <span class="required-star">*</span>
                        </label>

                        <input type="text"
                               name="location"
                               id="location"
                               class="form-control"
                               placeholder="เช่น ศูนย์พักพิง PawPals"
                               value="{{ old('location') }}"
                               required>

                    </div>


                    {{-- ABOUT --}}
                    <div class="mb-4">

                        <label for="about" class="form-label">
                            About (รายละเอียดเกี่ยวกับสัตว์เลี้ยง)
                            <span class="required-star">*</span>
                        </label>

                        <textarea name="about"
                                  id="about"
                                  class="form-control"
                                  rows="4"
                                  placeholder="อธิบายรายละเอียด นิสัย และข้อมูลเพิ่มเติมของสัตว์เลี้ยง..."
                                  required>{{ old('about') }}</textarea>

                    </div>


                    <hr class="my-4">


                    {{-- =====================================================
                         SECTION 2
                    ====================================================== --}}

                    <h5 class="form-section-title">

                        <span class="section-number">
                            2
                        </span>

                        บุคลิกภาพ
                        <small class="text-muted">
                            (Personality Level: 1-5)
                        </small>

                    </h5>


                    <div class="personality-box">

                        <div class="row">

                            {{-- SOCIAL --}}
                            <div class="col-md-4 mb-3 mb-md-0">

                                <label for="social_level"
                                       class="form-label personality-label">

                                    Shy
                                    <span class="text-muted">&lt;--&gt;</span>
                                    Social

                                </label>

                                <input type="range"
                                       name="social_level"
                                       id="social_level"
                                       min="1"
                                       max="5"
                                       value="{{ old('social_level', 3) }}"
                                       class="form-range">

                            </div>


                            {{-- TALKATIVE --}}
                            <div class="col-md-4 mb-3 mb-md-0">

                                <label for="talkative_level"
                                       class="form-label personality-label">

                                    Quiet
                                    <span class="text-muted">&lt;--&gt;</span>
                                    Talkative

                                </label>

                                <input type="range"
                                       name="talkative_level"
                                       id="talkative_level"
                                       min="1"
                                       max="5"
                                       value="{{ old('talkative_level', 3) }}"
                                       class="form-range">

                            </div>


                            {{-- ACTIVE --}}
                            <div class="col-md-4">

                                <label for="active_level"
                                       class="form-label personality-label">

                                    Sedentary
                                    <span class="text-muted">&lt;--&gt;</span>
                                    Active

                                </label>

                                <input type="range"
                                       name="active_level"
                                       id="active_level"
                                       min="1"
                                       max="5"
                                       value="{{ old('active_level', 3) }}"
                                       class="form-range">

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- =====================================================
                         SECTION 3
                    ====================================================== --}}

                    <h5 class="form-section-title">

                        <span class="section-number">
                            3
                        </span>

                        คุณลักษณะพิเศษ
                        <small class="text-muted">
                            (Attributes)
                        </small>

                    </h5>


                    <div class="row g-3">

                        {{-- APARTMENT --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_apartment_friendly"
                                           class="form-check-input"
                                           id="apt"
                                           value="1"
                                           {{ old('is_apartment_friendly') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="apt">

                                        Apartment Friendly

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- STUDIO --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_studio_friendly"
                                           class="form-check-input"
                                           id="studio"
                                           value="1"
                                           {{ old('is_studio_friendly') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="studio">

                                        Studio Friendly

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- POTTY --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_potty_trained"
                                           class="form-check-input"
                                           id="potty"
                                           value="1"
                                           {{ old('is_potty_trained') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="potty">

                                        Potty Trained

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- LEASH --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_leash_trained"
                                           class="form-check-input"
                                           id="leash"
                                           value="1"
                                           {{ old('is_leash_trained') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="leash">

                                        Leash Trained

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- PEOPLE --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_people_friendly"
                                           class="form-check-input"
                                           id="people"
                                           value="1"
                                           {{ old('is_people_friendly') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="people">

                                        People Friendly

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- DOG --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_dog_friendly"
                                           class="form-check-input"
                                           id="dog"
                                           value="1"
                                           {{ old('is_dog_friendly') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="dog">

                                        Dog Friendly

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- VACCINATED --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_vaccinated"
                                           class="form-check-input"
                                           id="vac"
                                           value="1"
                                           {{ old('is_vaccinated') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="vac">

                                        Vaccinated

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- HEALTHY --}}
                        <div class="col-md-3">

                            <div class="attribute-box">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_healthy"
                                           class="form-check-input"
                                           id="healthy"
                                           value="1"
                                           {{ old('is_healthy') ? 'checked' : '' }}>

                                    <label class="form-check-label attribute-label"
                                           for="healthy">

                                        Healthy

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- =====================================================
                         SECTION 4
                    ====================================================== --}}

                    <h5 class="form-section-title">

                        <span class="section-number">
                            4
                        </span>

                        สถานะการรับเลี้ยง
                        <small class="text-muted">
                            (Adoption Status)
                        </small>

                    </h5>


                    <div class="status-box mb-4">

                        <label for="adoption_status"
                               class="form-label">

                            สถานะการรับเลี้ยง
                            <span class="required-star">*</span>

                        </label>

                        <select name="adoption_status"
                                id="adoption_status"
                                class="form-select"
                                required>

                            <option value="available"
                                {{ old('adoption_status', 'available') === 'available' ? 'selected' : '' }}>
                                กำลังหาบ้าน (Available)
                            </option>

                            <option value="pending"
                                {{ old('adoption_status') === 'pending' ? 'selected' : '' }}>
                                อยู่ระหว่างการรับเลี้ยง (Pending)
                            </option>

                            <option value="adopted"
                                {{ old('adoption_status') === 'adopted' ? 'selected' : '' }}>
                                รับเลี้ยงแล้ว (Adopted)
                            </option>

                        </select>

                    </div>


                    {{-- =====================================================
                         IMAGE
                    ====================================================== --}}

                    <h5 class="form-section-title">

                        <span class="section-number">
                            5
                        </span>

                        รูปภาพสัตว์เลี้ยง
                        <small class="text-muted">
                            (Pet Image)
                        </small>

                    </h5>


                    <div class="image-box mb-4">

                        <label for="image"
                               class="form-label">

                            Pet Image

                        </label>

                        <input type="file"
                               name="image"
                               id="image"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,image/jpeg,image/png">

                        <small class="text-muted">
                            รองรับไฟล์ JPG, JPEG และ PNG ขนาดไม่เกิน 2MB
                        </small>

                    </div>


                    {{-- =====================================================
                         BUTTONS
                    ====================================================== --}}

                    <div class="form-actions">

                        <button type="submit"
                                class="btn btn-save-pet">

                            <i class="fa-solid fa-floppy-disk me-1"></i>

                            Save Pet

                        </button>


                        <a href="{{ route('pets.index') }}"
                           class="btn btn-secondary btn-back-pet">

                            <i class="fa-solid fa-arrow-left me-1"></i>

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection