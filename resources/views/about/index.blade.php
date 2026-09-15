@extends('pets.layout')
@section('title', 'About Us - PawPals')
@section('content')

<div class="container">
    <div class="card p-5 text-center">
        <div style="font-size: 60px;">
            🐾
        </div>

        <h2 class="fw-bold mt-3">
            About PawPals
        </h2>

        <p class="text-muted mt-3">
            PawPals คือเว็บไซต์ที่ช่วยเชื่อมต่อระหว่าง
            น้องหมา–น้องแมวที่กำลังมองหาบ้าน
            กับผู้ที่ต้องการรับเลี้ยงสัตว์
        </p>

        <hr class="my-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4">
                    <h4>🎯 จุดประสงค์</h4>
                    <p class="text-muted">
                        ช่วยรวบรวมข้อมูลสัตว์ที่กำลังหาบ้าน
                        ให้ผู้ที่สนใจสามารถค้นหาได้ง่าย
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4">
                    <h4>❤️ การรับเลี้ยง</h4>
                    <p class="text-muted">
                        สนับสนุนการรับเลี้ยงสัตว์
                        และช่วยให้น้อง ๆ ได้พบครอบครัวใหม่
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4">
                    <h4>🏠 เป้าหมาย</h4>
                    <p class="text-muted">
                        สร้างพื้นที่ที่ทำให้การค้นหา
                        และขอรับเลี้ยงสัตว์สะดวกมากขึ้น
                    </p>
                </div>
            </div>

        </div>

        <h4 class="mt-4">
            "น้องทุกตัวสมควรมีบ้านที่อบอุ่น" 🐶🐱
        </h4>
    </div>
</div>

@endsection