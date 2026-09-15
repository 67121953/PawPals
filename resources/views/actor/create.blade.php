@extends('actor.layout')
@section('title', 'เพิ่มข้อมูล actor')

@section('content')
<h3>Create a Actor</h3>

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

<form class="form-control" method="post" enctype="multipart/form-data" action="{{ route('actor.store') }}">
    @csrf
    @method('post')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" placeholder="name" />
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control" name="address" placeholder="address" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Female" id="genderFemale">
            <label class="form-check-label" for="genderFemale">Female</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Male" id="genderMale">
            <label class="form-check-label" for="genderMale">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="LGBTQIA+" id="genderLgbt">
            <label class="form-check-label" for="genderLgbt">LGBTQIA+</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Cost</label>
        <input class="form-control" type="text" name="cost" placeholder="ค่าตัวนักแสดงเป็นตัวเลข" />
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        <input class="form-control" type="file" name="image" placeholder="image" />
    </div>

    <div class="mb-3">
        <label class="form-label">Belong : สังกัดนักแสดง</label>
        <select class="form-select" name="belong">
            <option value="1">ช่อง 3</option>
            <option value="2">ช่อง 7</option>
            <option value="3">อิสระ</option>
        </select>
    </div>

    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Save" />
    </div>
</form>
@endsection
