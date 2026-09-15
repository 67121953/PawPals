@extends('pets.layout')
@section('title', 'Pet Care - PawPals')
@section('content')

<div class="container">

    <div class="text-center mb-5">
        <h2>🐾 Pet Care</h2>
        <p class="text-muted">
            คำแนะนำในการดูแลน้องหมาและน้องแมว
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">🍚</div>
                <h4 class="mt-3">การให้อาหาร</h4>
                <p class="text-muted">
                    เลือกอาหารให้เหมาะสมกับอายุ
                    ขนาด และสุขภาพของสัตว์เลี้ยง
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">💉</div>
                <h4 class="mt-3">วัคซีน</h4>
                <p class="text-muted">
                    พาน้องไปพบสัตวแพทย์และฉีดวัคซีน
                    ตามกำหนดอย่างสม่ำเสมอ
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">🛁</div>
                <h4 class="mt-3">ความสะอาด</h4>
                <p class="text-muted">
                    ดูแลความสะอาดของตัวน้อง
                    ที่นอน และบริเวณที่อยู่อาศัย
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">🩺</div>
                <h4 class="mt-3">สุขภาพ</h4>
                <p class="text-muted">
                    หมั่นสังเกตพฤติกรรมและอาการผิดปกติ <br>
                    หากพบความผิดปกติควรพบสัตวแพทย์
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">🏠</div>
                <h4 class="mt-3">เตรียมบ้าน</h4>
                <p class="text-muted">
                    เตรียมพื้นที่ อาหาร น้ำ และสิ่งของจำเป็น <br> ก่อนรับน้องเข้าบ้าน
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100">
                <div style="font-size: 45px;">❤️</div>
                <h4 class="mt-3">ความรัก</h4>
                <p class="text-muted">
                    ให้ความรัก ความเอาใจใส่
                    และใช้เวลาทำกิจกรรม <br>ร่วมกับน้อง
                </p>
            </div>
        </div>

    </div>

</div>

@endsection