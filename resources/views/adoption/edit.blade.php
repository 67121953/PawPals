@extends('pets.layout')
@section('title', 'แก้ไขข้อมูลขอรับเลี้ยง')
@section('content')
 
<div class="container">
 
    <h2>✏️ แก้ไขข้อมูลขอรับเลี้ยง</h2>
 
    <form action="{{ route('adoption.update', $adoption->id) }}"
          method="POST">
 
        @csrf
        @method('PUT')
 
 
        <!-- เลือกสัตว์ -->
        <div class="mb-3">
            <label>น้องที่ต้องการรับเลี้ยง</label>
            <select name="pet_id"
                    class="form-control"
                    required>
 
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}"
                        {{ $adoption->pet_id == $pet->id ? 'selected' : '' }}>
 
                        {{ $pet->name }} - {{ $pet->type }}
 
                    </option>
                @endforeach
            </select>
 
        </div>
 
 
        <!-- ชื่อ -->
        <div class="mb-3">
            <label>ชื่อ - นามสกุล</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $adoption->name }}"
                   required>
 
        </div>
 
 
        <!-- เบอร์โทร -->
        <div class="mb-3">
            <label>เบอร์โทรศัพท์</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   value="{{ $adoption->phone }}"
                   required>
        </div>
 
 
        <!-- Email -->
        <div class="mb-3">
            <label>อีเมล</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ $adoption->email }}"
                   required>
        </div>
 
 
        <!-- ที่อยู่ -->
        <div class="mb-3">
 
            <label>ที่อยู่</label>
            <textarea name="address"
                      class="form-control"
                      rows="3"
                      required>{{ $adoption->address }}</textarea>
        </div>
 
 
        <!-- อาชีพ -->
        <div class="mb-3">
            <label>อาชีพ</label>
            <input type="text"
                   name="occupation"
                   class="form-control"
                   value="{{ $adoption->occupation }}">
        </div>
 
 
        <!-- ประสบการณ์ -->
        <div class="mb-3">
            <label>เคยเลี้ยงสัตว์มาก่อนหรือไม่?</label>
            <select name="experience"
                    class="form-control"
                    required>
 
                <option value="yes"
                    {{ $adoption->experience == 'yes' ? 'selected' : '' }}>
                    เคย
                </option>
 
                <option value="no"
                    {{ $adoption->experience == 'no' ? 'selected' : '' }}>
                    ไม่เคย
                </option>
            </select>
        </div>
 
 
        <!-- เหตุผล -->
        <div class="mb-3">
            <label>เหตุผลที่ต้องการรับเลี้ยง</label>
            <textarea name="reason"
                      class="form-control"
                      rows="4"
                      required>{{ $adoption->reason }}</textarea>
        </div>
 
 
        <!-- ปุ่ม -->
        <button type="submit"
                class="btn btn-primary">
            💾 บันทึกการแก้ไข
        </button>
 
        <a href="{{ route('adoption.index') }}"
           class="btn btn-secondary">
            ยกเลิก
        </a>
 
    </form>
</div>
@endsection