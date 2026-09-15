@extends('pets.layout')
@section('title', 'Add New Pet - PawPals')
@section('content')

<div class="container mt-4 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                Add New Pet (เพิ่มข้อมูลสัตว์เลี้ยง)
            </h3>
        </div>

        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>ไม่สามารถบันทึกข้อมูลได้</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('pets.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <h5 class="text-primary mb-3">
                    1. ข้อมูลทั่วไป (General Information)
                </h5>

                <div class="row">

                    {{-- Pet Name --}}
                    <div class="col-md-6 mb-3">

                        <label for="name" class="form-label">
                            Pet Name (ชื่อสัตว์เลี้ยง)
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="เช่น Charlie"
                               value="{{ old('name') }}"
                               required>

                    </div>


                    {{-- Type --}}
                    <div class="col-md-6 mb-3">

                        <label for="type" class="form-label">
                            Type (ประเภทสัตว์เลี้ยง)
                        </label>

                        <select name="type"
                                id="type"
                                class="form-control"
                                required>

                            <option value="">
                                -- เลือกประเภท --
                            </option>

                            <option value="Dog"
                                {{ old('type') == 'Dog' ? 'selected' : '' }}>
                                หมา (Dog)
                            </option>

                            <option value="Cat"
                                {{ old('type') == 'Cat' ? 'selected' : '' }}>
                                แมว (Cat)
                            </option>
                        </select>
                    </div>
                </div>


                <div class="row">

                    {{-- Age --}}
                    <div class="col-md-3 mb-3">

                        <label for="age" class="form-label">
                            Age (อายุ)
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
                                    {{ old('age_unit', 'years') == 'years' ? 'selected' : '' }}>
                                    ปี
                                </option>

                                <option value="months"
                                    {{ old('age_unit') == 'months' ? 'selected' : '' }}>
                                    เดือน
                                </option>
                            </select>
                        </div>
                    </div>


                    {{-- Weight --}}
                    <div class="col-md-3 mb-3">
                        <label for="weight_lbs" class="form-label">
                            Weight (น้ำหนัก/ปอนด์)
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


                    {{-- Breed --}}
                    <div class="col-md-3 mb-3">
                        <label for="breed" class="form-label">
                            Breed (สายพันธุ์)
                        </label>
                        <input type="text"
                               name="breed"
                               id="breed"
                               class="form-control"
                               placeholder="เช่น Retriever Mix"
                               value="{{ old('breed') }}"
                               required>

                    </div>


                    {{-- Gender --}}
                    <div class="col-md-3 mb-3">

                        <label for="gender" class="form-label">
                            Gender (เพศ)
                        </label>

                        <select name="gender"
                                id="gender"
                                class="form-control"
                                required>

                            <option value="">
                                -- เลือกเพศ --
                            </option>

                            <option value="Male"
                                {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                ผู้ (Male)
                            </option>

                            <option value="Female"
                                {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                เมีย (Female)
                            </option>
                        </select>
                    </div>
                </div>


                {{-- Location --}}
                <div class="mb-3">
                    <label for="location" class="form-label">
                        Location (สถานที่/ศูนย์พักพิง)
                    </label>
                    <input type="text"
                           name="location"
                           id="location"
                           class="form-control"
                           placeholder="เช่น Pet Food Express, San Francisco, CA"
                           value="{{ old('location') }}"
                           required>

                </div>

                {{-- About --}}
                <div class="mb-3">
                    <label for="about" class="form-label">
                        About (รายละเอียดเกี่ยวกับสัตว์เลี้ยง)
                    </label>
                    <textarea name="about"
                              id="about"
                              class="form-control"
                              rows="3"
                              required>{{ old('about') }}</textarea>

                </div>

                <hr class="my-4">

                <h5 class="text-primary mb-3">
                    2. บุคลิกภาพ (Personality Level: 1-5)
                </h5>
                <div class="row">
                    {{-- Social --}}
                    <div class="col-md-4 mb-3">
                        <label for="social_level" class="form-label">
                            Shy &lt;--&gt; Social
                        </label>
                        <input type="range"
                               name="social_level"
                               id="social_level"
                               min="1"
                               max="5"
                               value="{{ old('social_level', 3) }}"
                               class="form-range">

                    </div>


                    {{-- Talkative --}}
                    <div class="col-md-4 mb-3">
                        <label for="talkative_level" class="form-label">
                            Quiet &lt;--&gt; Talkative
                        </label>
                        <input type="range"
                               name="talkative_level"
                               id="talkative_level"
                               min="1"
                               max="5"
                               value="{{ old('talkative_level', 3) }}"
                               class="form-range">
                    </div>


                    {{-- Active --}}
                    <div class="col-md-4 mb-3">
                        <label for="active_level" class="form-label">
                            Sedentary &lt;--&gt; Active
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

                <hr class="my-4">
                <h5 class="text-primary mb-3">
                    3. คุณลักษณะพิเศษ (Attributes)
                </h5>

                <div class="row">
                    {{-- Apartment --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_apartment_friendly"
                                   class="form-check-input"
                                   id="apt"
                                   value="1"
                                   {{ old('is_apartment_friendly') ? 'checked' : '' }}>

                            <label class="form-check-label" for="apt">
                                Apartment Friendly
                            </label>
                        </div>
                    </div>


                    {{-- Studio --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_studio_friendly"
                                   class="form-check-input"
                                   id="studio"
                                   value="1"
                                   {{ old('is_studio_friendly') ? 'checked' : '' }}>

                            <label class="form-check-label" for="studio">
                                Studio Friendly
                            </label>
                        </div>
                    </div>


                    {{-- Potty --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_potty_trained"
                                   class="form-check-input"
                                   id="potty"
                                   value="1"
                                   {{ old('is_potty_trained') ? 'checked' : '' }}>

                            <label class="form-check-label" for="potty">
                                Potty Trained
                            </label>
                        </div>
                    </div>


                    {{-- Leash --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_leash_trained"
                                   class="form-check-input"
                                   id="leash"
                                   value="1"
                                   {{ old('is_leash_trained') ? 'checked' : '' }}>

                            <label class="form-check-label" for="leash">
                                Leash Trained
                            </label>
                        </div>
                    </div>


                    {{-- People --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_people_friendly"
                                   class="form-check-input"
                                   id="people"
                                   value="1"
                                   {{ old('is_people_friendly') ? 'checked' : '' }}>

                            <label class="form-check-label" for="people">
                                People Friendly
                            </label>
                        </div>
                    </div>


                    {{-- Dog --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_dog_friendly"
                                   class="form-check-input"
                                   id="dog"
                                   value="1"
                                   {{ old('is_dog_friendly') ? 'checked' : '' }}>

                            <label class="form-check-label" for="dog">
                                Dog Friendly
                            </label>
                        </div>
                    </div>


                    {{-- Vaccinated --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_vaccinated"
                                   class="form-check-input"
                                   id="vac"
                                   value="1"
                                   {{ old('is_vaccinated') ? 'checked' : '' }}>

                            <label class="form-check-label" for="vac">
                                Vaccinated
                            </label>
                        </div>
                    </div>
                    {{-- Healthy --}}
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_healthy"
                                   class="form-check-input"
                                   id="healthy"
                                   value="1"
                                   {{ old('is_healthy') ? 'checked' : '' }}>

                            <label class="form-check-label" for="healthy">
                                Healthy
                            </label>
                        </div>
                    </div>
                </div>


                <hr class="my-4">
                <h5 class="text-primary mb-3">
                    4. สถานะการรับเลี้ยง (Adoption Status)
                </h5>

                <div class="mb-4">
                    <label for="adoption_status" class="form-label">
                        สถานะการรับเลี้ยง
                    </label>

                    <select name="adoption_status"
                            id="adoption_status"
                            class="form-control"
                            required>

                        <option value="available"
                            {{ old('adoption_status', 'available') == 'available' ? 'selected' : '' }}>
                            กำลังหาบ้าน (Available)
                        </option>

                        <option value="pending"
                            {{ old('adoption_status') == 'pending' ? 'selected' : '' }}>
                            อยู่ระหว่างการรับเลี้ยง (Pending)
                        </option>

                        <option value="adopted"
                            {{ old('adoption_status') == 'adopted' ? 'selected' : '' }}>
                            รับเลี้ยงแล้ว (Adopted)
                        </option>
                    </select>
                </div>

                <hr class="my-4">
                <div class="mb-4">
                    <label for="image" class="form-label">
                        Pet Image (รูปภาพสัตว์เลี้ยง)
                    </label>
                    <input type="file"
                           name="image"
                           id="image"
                           class="form-control"
                           accept=".jpg,.jpeg,.png">
                    <small class="text-muted">
                        รองรับไฟล์ JPG, JPEG และ PNG ขนาดไม่เกิน 2MB
                    </small>
                </div>

                <button type="submit"
                        class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-1"></i>
                    Save Pet
                </button>


                <a href="{{ route('pets.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>

@endsection