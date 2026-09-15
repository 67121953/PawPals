@extends('pets.layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">Edit Pet (แก้ไขข้อมูลสัตว์เลี้ยง)</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5 class="text-primary mb-3">1. ข้อมูลทั่วไป (General Information)</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Pet Name (ชื่อสัตว์เลี้ยง)</label>
                        <input type="text" name="name" class="form-control" value="{{ $pet->name }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type (ประเภทสัตว์เลี้ยง)</label>
                        <select name="type" class="form-control" required>
                            <option value="Dog" {{ $pet->type == 'Dog' ? 'selected' : '' }}>หมา (Dog)</option>
                            <option value="Cat" {{ $pet->type == 'Cat' ? 'selected' : '' }}>แมว (Cat)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- คำนวณค่าเพื่อนำมาดึงใส่ใน Input และ Select -->
                    @php
                        $isMonth = $pet->age_years < 1 && $pet->age_years > 0;
                        $displayAge = $isMonth ? round($pet->age_years * 12) : $pet->age_years;
                    @endphp

                    <!-- ส่วนกรอกอายุ (Age) พร้อมเลือก ปี/เดือน -->
                    <div class="col-md-3 mb-3">
                        <label for="age" class="form-label">Age (อายุ)</label>
                        <div class="input-group">
                            <input type="number" name="age" step="any" class="form-control" value="{{ $displayAge }}" min="0" required>
                            <select name="age_unit" class="form-select" style="max-width: 110px;">
                                <option value="years" {{ !$isMonth ? 'selected' : '' }}>ปี</option>
                                <option value="months" {{ $isMonth ? 'selected' : '' }}>เดือน</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="weight_lbs" class="form-label">Weight (น้ำหนัก/ปอนด์)</label>
                        <input type="number" step="0.1" name="weight_lbs" class="form-control" value="{{ $pet->weight_lbs }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="breed" class="form-label">Breed (สายพันธุ์)</label>
                        <input type="text" name="breed" class="form-control" value="{{ $pet->breed }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="gender" class="form-label">Gender (เพศ)</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" {{ $pet->gender == 'Male' ? 'selected' : '' }}>ผู้ (Male)</option>
                            <option value="Female" {{ $pet->gender == 'Female' ? 'selected' : '' }}>เมีย (Female)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location (สถานที่/ศูนย์พักพิง)</label>
                    <input type="text" name="location" class="form-control" value="{{ $pet->location }}" required>
                </div>

                <div class="mb-3">
                    <label for="about" class="form-label">About (รายละเอียดเกี่ยวกับสัตว์เลี้ยง)</label>
                    <textarea name="about" class="form-control" rows="3" required>{{ $pet->about }}</textarea>
                </div>

                <hr class="my-4">

                <h5 class="text-primary mb-3">2. บุคลิกภาพ (Personality Level: 1-5)</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="social_level" class="form-label">Shy <--> Social</label>
                        <input type="range" name="social_level" min="1" max="5" value="{{ $pet->social_level }}" class="form-range">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="talkative_level" class="form-label">Quiet <--> Talkative</label>
                        <input type="range" name="talkative_level" min="1" max="5" value="{{ $pet->talkative_level }}" class="form-range">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="active_level" class="form-label">Sedentary <--> Active</label>
                        <input type="range" name="active_level" min="1" max="5" value="{{ $pet->active_level }}" class="form-range">
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="text-primary mb-3">3. คุณลักษณะพิเศษ (Attributes)</h5>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_apartment_friendly" class="form-check-input" id="apt" {{ $pet->is_apartment_friendly ? 'checked' : '' }}>
                            <label class="form-check-label" for="apt">Apartment Friendly</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_studio_friendly" class="form-check-input" id="studio" {{ $pet->is_studio_friendly ? 'checked' : '' }}>
                            <label class="form-check-label" for="studio">Studio Friendly</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_potty_trained" class="form-check-input" id="potty" {{ $pet->is_potty_trained ? 'checked' : '' }}>
                            <label class="form-check-label" for="potty">Potty Trained</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_leash_trained" class="form-check-input" id="leash" {{ $pet->is_leash_trained ? 'checked' : '' }}>
                            <label class="form-check-label" for="leash">Leash Trained</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_people_friendly" class="form-check-input" id="people" {{ $pet->is_people_friendly ? 'checked' : '' }}>
                            <label class="form-check-label" for="people">People Friendly</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_dog_friendly" class="form-check-input" id="dog" {{ $pet->is_dog_friendly ? 'checked' : '' }}>
                            <label class="form-check-label" for="dog">Dog Friendly</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_vaccinated" class="form-check-input" id="vac" {{ $pet->is_vaccinated ? 'checked' : '' }}>
                            <label class="form-check-label" for="vac">Vaccinated</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="is_healthy" class="form-check-input" id="healthy" {{ $pet->is_healthy ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthy">Healthy</label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

<h5 class="text-primary mb-3">4. สถานะการรับเลี้ยง (Adoption Status)</h5>

<div class="col-md-6 mb-3">
    <label for="adoption_status" class="form-label">
        สถานะการรับเลี้ยง
    </label>

    <select name="adoption_status" id="adoption_status" class="form-control" required>
        <option value="available"
            {{ $pet->adoption_status == 'available' ? 'selected' : '' }}>
            กำลังหาบ้าน (Available)
        </option>

        <option value="pending"
            {{ $pet->adoption_status == 'pending' ? 'selected' : '' }}>
            อยู่ระหว่างการรับเลี้ยง (Pending)
        </option>

        <option value="adopted"
            {{ $pet->adoption_status == 'adopted' ? 'selected' : '' }}>
            รับเลี้ยงแล้ว (Adopted)
        </option>
    </select>
</div>
                <hr class="my-4">

                <div class="mb-4">
                    <label for="image" class="form-label">Pet Image (เปลี่ยนรูปภาพใหม่)</label>
                    <input type="file" name="image" class="form-control mb-2">
                    @if($pet->image)
                        <div class="mt-2">
                            <small class="text-muted d-block">รูปภาพปัจจุบัน:</small>
                            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" style="max-height: 150px;" class="rounded border p-1 mt-1">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-warning">Update (บันทึกการแก้ไข)</button>
                <a href="{{ route('pets.index') }}" class="btn btn-secondary">Back (ยกเลิก)</a>
            </form>
        </div>
    </div>
</div>
@endsection