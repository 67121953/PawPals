@extends('pets.layout')

@section('title', 'Contact Us - PawPals')

@section('content')

<div class="container">

    <div class="card p-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                📞 Contact Us
            </h2>

            <p class="text-muted">
                ติดต่อ PawPals
                หากมีข้อสงสัยเกี่ยวกับการรับเลี้ยง
            </p>

        </div>


        {{-- แสดงข้อความเมื่อส่งสำเร็จ --}}

        @if(session('success'))

            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>

        @endif


        <div class="row g-4">


            {{-- =========================
                 ข้อมูลติดต่อ
            ========================== --}}

            <div class="col-md-5">


                {{-- Email --}}

                <div class="p-4 mb-3"
                     style="background:#f5f3ff;border-radius:15px;">

                    <h5>
                        📧 Email
                    </h5>

                    <p class="text-muted mb-0">
                        pawpals@example.com
                    </p>

                </div>


                {{-- Phone --}}

                <div class="p-4 mb-3"
                     style="background:#f5f3ff;border-radius:15px;">

                    <h5>
                        📞 Phone
                    </h5>

                    <p class="text-muted mb-0">
                        08X-XXX-XXXX
                    </p>

                </div>


                {{-- Location --}}

                <div class="p-4 mb-3"
                     style="background:#f5f3ff;border-radius:15px;">

                    <h5>
                        📍 Location
                    </h5>

                    <p class="text-muted mb-0">
                        จังหวัดเชียงใหม่ ประเทศไทย
                    </p>

                </div>


            </div>



            {{-- =========================
                 Contact Form
            ========================== --}}

            <div class="col-md-7">

                <h4 class="fw-bold mb-4">
                    💌 ส่งข้อความถึงเรา
                </h4>


                {{-- ต้องส่งไป contact.store --}}

                <form action="{{ route('contact.store') }}"
                      method="POST">

                    @csrf


                    {{-- ชื่อ --}}

                    <div class="mb-3">

                        <label class="form-label">
                            ชื่อ - นามสกุล
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="กรุณากรอกชื่อ"
                               required>

                    </div>


                    {{-- Email --}}

                    <div class="mb-3">

                        <label class="form-label">
                            อีเมล
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="example@email.com"
                               required>

                    </div>


                    {{-- Message --}}

                    <div class="mb-3">

                        <label class="form-label">
                            ข้อความ
                        </label>

                        <textarea name="message"
                                  class="form-control"
                                  rows="5"
                                  placeholder="พิมพ์ข้อความ..."
                                  required></textarea>

                    </div>


                    {{-- ปุ่มส่ง --}}

                    <button type="submit"
                            class="btn btn-purple">

                        💌 ส่งข้อความ

                    </button>


                </form>

            </div>

        </div>

    </div>

</div>

@endsection