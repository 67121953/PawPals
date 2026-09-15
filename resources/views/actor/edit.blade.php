@extends('actor.layout')
@section('title', 'แก้ไขข้อมูล actor')

@section('content')
<h3>Edit a Actor</h3>

<div>
    {{-- แสดงข้อความแจ้งเตือนเมื่อระบุข้อมูลไม่ถูกต้อง (Validation Error) --}}
    @if($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>

<form class="form-control" method="post" enctype="multipart/form-data" action="{{ route('actor.update', ['actor' => $actor]) }}">
    @csrf
    @method('put')

    {{-- เก็บ 경로/ชื่อรูปภาพเดิมไว้ใช้เช็กกรณีไม่ได้อัปโหลดรูปใหม่ --}}
    <input type="hidden" name="oldimage" id="oldimage" value="{{ $actor->image }}" /><br>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" placeholder="name" value="{{ $actor->name }}" />
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control" name="address" placeholder="address" rows="3">{{ $actor->address }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Female" {{ ($actor->gender == "Female") ? "checked" : "" }}>
            <label class="form-check-label">Female</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Male" {{ ($actor->gender == "Male") ? "checked" : "" }}>
            <label class="form-check-label">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="LGBTQIA+" {{ ($actor->gender == "LGBTQIA+") ? "checked" : "" }}>
            <label class="form-check-label">LGBTQIA+</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Cost</label>
        <input class="form-control" type="text" name="cost" placeholder="ค่าตัวนักแสดงเป็นตัวเลข" value="{{ $actor->cost }}" />
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label><br>
        {{-- แสดงรูปภาพเดิมที่มีอยู่ในระบบ --}}
        <img src="{{ asset($actor->image) }}" width="100" height="100" class="img img-responsive mb-2"><br>
        <input class="form-control" type="file" name="image" placeholder="image" />
    </div>

    <div class="mb-3">
        <label class="form-label">Belong : สังกัดนักแสดง</label>
        <select class="form-select" name="belong">
            <option value="1" {{ ($actor->belong == "1") ? "selected" : "" }}>ช่อง 3</option>
            <option value="2" {{ ($actor->belong == "2") ? "selected" : "" }}>ช่อง 7</option>
            <option value="3" {{ ($actor->belong == "3") ? "selected" : "" }}>อิสระ</option>
        </select>
    </div>

    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Save" />
    </div>
</form>
@endsection