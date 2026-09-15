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


        {{-- แสดง Error --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="row g-4">


            {{-- =========================
                 ข้อมูลติดต่อ
            ========================== --}}

            <div class="col-md-5">


                {{-- Email --}}

                <div
                    class="p-4 mb-3"
                    style="background:#f5f3ff;border-radius:15px;"
                >

                    <h5>
                        📧 Email
                    </h5>

                    <p class="text-muted mb-0">
                        pawpals@example.com
                    </p>

                </div>


                {{-- Phone --}}

                <div
                    class="p-4 mb-3"
                    style="background:#f5f3ff;border-radius:15px;"
                >

                    <h5>
                        📞 Phone
                    </h5>

                    <p class="text-muted mb-0">
                        08X-XXX-XXXX
                    </p>

                </div>


                {{-- Location --}}

                <div
                    class="p-4 mb-3"
                    style="background:#f5f3ff;border-radius:15px;"
                >

                    <h5>
                        📍 Location
                    </h5>

                    <p class="text-muted mb-0">
                        จังหวัดเชียงใหม่ ประเทศไทย
                    </p>

                </div>


                {{-- Chat Info --}}

                <div
                    class="p-4"
                    style="background:#fff7ed;border-radius:15px;"
                >

                    <h5>
                        💬 Live Chat
                    </h5>

                    <p class="text-muted mb-0">

                        @auth

                            สามารถส่งข้อความหา Admin
                            และรอรับการตอบกลับผ่านระบบ Chat ได้เลย

                        @else

                            กรุณาเข้าสู่ระบบก่อน
                            เพื่อสนทนากับ Admin

                        @endauth

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


                @auth

                    <form
                        action="{{ route('contact.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- ชื่อ --}}

                        <div class="mb-3">

                            <label class="form-label">
                                ชื่อ - นามสกุล
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ auth()->user()->name }}"
                                readonly
                            >

                        </div>


                        {{-- Email --}}

                        <div class="mb-3">

                            <label class="form-label">
                                อีเมล
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ auth()->user()->email }}"
                                readonly
                            >

                        </div>


                        {{-- Message --}}

                        <div class="mb-3">

                            <label class="form-label">
                                ข้อความ
                            </label>

                            <textarea
                                name="message"
                                class="form-control"
                                rows="5"
                                placeholder="พิมพ์ข้อความ..."
                                required
                            ></textarea>

                        </div>


                        {{-- ปุ่มส่ง --}}

                        <button
                            type="submit"
                            class="btn btn-purple"
                        >

                            <i class="fa-solid fa-paper-plane me-1"></i>

                            ส่งข้อความ

                        </button>


                    </form>


                @else


                    {{-- Guest --}}

                    <div class="text-center p-5 bg-light rounded-4">

                        <div
                            class="mb-3"
                            style="font-size:50px;"
                        >
                            💬
                        </div>

                        <h5 class="fw-bold">
                            เข้าสู่ระบบเพื่อส่งข้อความ
                        </h5>

                        <p class="text-muted">
                            คุณต้อง Login ก่อนจึงจะสามารถติดต่อกับ Admin
                            ผ่านระบบ Chat ได้
                        </p>

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-purple"
                        >

                            <i class="fa-solid fa-right-to-bracket me-1"></i>

                            เข้าสู่ระบบ

                        </a>

                    </div>


                @endauth


            </div>

        </div>

    </div>

</div>

@endsection