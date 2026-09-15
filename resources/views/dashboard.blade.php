<x-app-layout>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* =========================
           HERO - เหมือน Welcome
        ========================= */
        .hero {
            background:
                linear-gradient(
                    90deg,
                    rgba(255, 247, 237, 0.98) 0%,
                    rgba(255, 247, 237, 0.88) 45%,
                    rgba(255, 247, 237, 0.25) 100%
                ),
                url('https://images.unsplash.com/photo-1601758228041-f3b2795255f1?auto=format&fit=crop&w=1800&q=80');

            background-size: cover;
            background-position: center;
            min-height: 620px;
        }

        .hero-title {
            font-size: 4rem;
            line-height: 1.1;
            font-weight: 800;
        }

        /* =========================
           CARD
        ========================= */
        .paw-card {
            transition: all 0.3s ease;
        }

        .paw-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.08);
        }

        .paw-icon {
            width: 65px;
            height: 65px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }
    </style>


    {{-- =========================================================
         HERO SECTION
         รูป + การจัดองค์ประกอบเหมือน Welcome
    ========================================================== --}}

    <section class="hero flex items-center">

        <div class="max-w-7xl mx-auto w-full px-6">

            <div class="max-w-2xl">


                {{-- Welcome Badge --}}
                <div class="inline-flex items-center gap-2
                            bg-white/90 rounded-full px-5 py-2
                            text-orange-600 font-semibold shadow-sm mb-6">

                    🐾

                    <span>
                        ยินดีต้อนรับกลับสู่ PawPals
                    </span>

                </div>


                {{-- Hero Title --}}
                <h1 class="hero-title text-gray-800 mb-6">

                    เพื่อนตัวน้อย

                    <br>

                    <span class="text-orange-500">
                        กำลังรอบ้านใหม่
                    </span>

                </h1>


                {{-- Description --}}
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed mb-8">

                    PawPals คือระบบที่ช่วยเชื่อมต่อระหว่าง
                    สัตว์เลี้ยงที่กำลังรอบ้าน
                    กับคนที่พร้อมมอบความรักและครอบครัวให้พวกเขา

                </p>


                {{-- Buttons --}}
                <div class="flex flex-wrap gap-4">


                    {{-- ดูสัตว์ --}}
                    <a href="{{ route('pets.index') }}"
                       class="inline-flex items-center gap-2
                              px-7 py-4 rounded-full
                              bg-orange-500 text-white
                              font-bold text-lg
                              shadow-lg shadow-orange-200
                              hover:bg-orange-600
                              hover:-translate-y-1
                              transition">

                        🐶

                        ดูสัตว์ที่รอการรับเลี้ยง

                        <span>→</span>

                    </a>


                    {{-- ปุ่มตาม Role --}}
                    @if(Auth::user()->role === 'admin')

                        <a href="{{ route('admin.adoptions.index') }}"
                           class="inline-flex items-center
                                  px-7 py-4 rounded-full
                                  bg-white text-gray-700
                                  font-semibold text-lg
                                  shadow-md
                                  hover:bg-gray-50
                                  transition">

                            📋 คำขอรับเลี้ยง

                        </a>

                    @else

                        <a href="{{ route('about-us') }}"
                           class="inline-flex items-center
                                  px-7 py-4 rounded-full
                                  bg-white text-gray-700
                                  font-semibold text-lg
                                  shadow-md
                                  hover:bg-gray-50
                                  transition">

                            รู้จัก PawPals

                        </a>

                    @endif


                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
         INTRODUCTION
         รูปแบบเดียวกับ Welcome
    ========================================================== --}}

    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6">


            {{-- Heading --}}
            <div class="text-center max-w-3xl mx-auto mb-14">

                <span class="text-orange-500 font-bold">
                    🐾 PAWPALS
                </span>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-3 mb-4">

                    @if(Auth::user()->role === 'admin')
                        จัดการระบบ PawPals
                    @else
                        เพราะทุกชีวิตควรมีบ้าน
                    @endif

                </h2>

                <p class="text-gray-500 text-lg leading-relaxed">

                    @if(Auth::user()->role === 'admin')

                        เครื่องมือสำหรับจัดการข้อมูลสัตว์
                        และคำขอรับสัตว์ไปเลี้ยง

                    @else

                        เราต้องการช่วยให้สัตว์เลี้ยงที่กำลังรอครอบครัว
                        ได้พบกับคนที่พร้อมดูแลและมอบความรักให้กับพวกเขา

                    @endif

                </p>

            </div>



            {{-- =================================================
                 USER CARDS
            ================================================== --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


                {{-- Card 1 --}}
                <a href="{{ route('pets.index') }}"
                   class="paw-card bg-orange-50 rounded-3xl p-8 block">

                    <div class="paw-icon bg-orange-100 mb-6">
                        🐶
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        สัตว์เลี้ยงที่รอบ้าน
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        ค้นหาสัตว์เลี้ยงที่กำลังรอครอบครัวใหม่
                        พร้อมดูข้อมูลและรายละเอียดของแต่ละตัว
                    </p>

                    <div class="mt-5 text-orange-500 font-semibold">
                        ดูสัตว์ทั้งหมด →
                    </div>

                </a>



                {{-- Card 2 --}}
                <a href="{{ route('pet-care') }}"
                   class="paw-card bg-green-50 rounded-3xl p-8 block">

                    <div class="paw-icon bg-green-100 mb-6">
                        ❤️
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        การดูแลที่เหมาะสม
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        เรียนรู้ข้อมูลเกี่ยวกับการดูแลสัตว์เลี้ยง
                        เพื่อให้พวกเขามีสุขภาพดีและมีความสุข
                    </p>

                    <div class="mt-5 text-green-600 font-semibold">
                        เรียนรู้เพิ่มเติม →
                    </div>

                </a>



                {{-- Card 3 --}}
                <a href="{{ route('about-us') }}"
                   class="paw-card bg-purple-50 rounded-3xl p-8 block">

                    <div class="paw-icon bg-purple-100 mb-6">
                        🏠
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        บ้านใหม่ที่อบอุ่น
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        ช่วยให้สัตว์เลี้ยงได้พบกับครอบครัว
                        ที่พร้อมมอบความรักและดูแลพวกเขา
                    </p>

                    <div class="mt-5 text-purple-600 font-semibold">
                        รู้จัก PawPals →
                    </div>

                </a>


            </div>

        </div>

    </section>



    {{-- =========================================================
         ADMIN SECTION
         ยังคงของเดิมไว้ แต่ปรับหน้าตาให้เข้ากับ Welcome
    ========================================================== --}}

    @if(Auth::user()->role === 'admin')

        <section class="py-20 bg-orange-50">

            <div class="max-w-7xl mx-auto px-6">


                <div class="text-center max-w-3xl mx-auto mb-14">

                    <span class="text-orange-500 font-bold">
                        🐾 ADMIN PANEL
                    </span>

                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-3 mb-4">
                        จัดการระบบ PawPals
                    </h2>

                    <p class="text-gray-500 text-lg leading-relaxed">
                        เครื่องมือสำหรับผู้ดูแลระบบ
                        เพื่อจัดการข้อมูลและคำขอรับเลี้ยง
                    </p>

                </div>



                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


                    {{-- Add Pet --}}
                    <a href="{{ route('pets.create') }}"
                       class="paw-card bg-white rounded-3xl p-8 block">

                        <div class="paw-icon bg-orange-100 mb-6">
                            ➕
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-3">
                            เพิ่มสัตว์
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            เพิ่มข้อมูลสัตว์ที่พร้อมสำหรับ
                            การรับเลี้ยงเข้าสู่ระบบ
                        </p>

                        <div class="mt-5 text-orange-500 font-semibold">
                            เพิ่มข้อมูล →
                        </div>

                    </a>



                    {{-- Adoption Requests --}}
                    <a href="{{ route('admin.adoptions.index') }}"
                       class="paw-card bg-white rounded-3xl p-8 block">

                        <div class="paw-icon bg-green-100 mb-6">
                            📋
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-3">
                            คำขอรับเลี้ยง
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            ตรวจสอบและจัดการคำขอ
                            รับสัตว์ไปเลี้ยง
                        </p>

                        <div class="mt-5 text-green-600 font-semibold">
                            ดูคำขอ →
                        </div>

                    </a>



                    {{-- Manage Pets --}}
                    <a href="{{ route('pets.index') }}"
                       class="paw-card bg-white rounded-3xl p-8 block">

                        <div class="paw-icon bg-purple-100 mb-6">
                            🐕
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-3">
                            จัดการสัตว์
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            แก้ไข ลบ และตรวจสอบข้อมูลสัตว์
                            ในระบบ PawPals
                        </p>

                        <div class="mt-5 text-purple-600 font-semibold">
                            จัดการข้อมูล →
                        </div>

                    </a>


                </div>

            </div>

        </section>

    @endif



    {{-- =========================================================
         CTA
         เหมือน Welcome
    ========================================================== --}}

    <section class="py-20 bg-orange-500">

        <div class="max-w-5xl mx-auto px-6 text-center">

            <div class="text-6xl mb-6">
                🐾
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">

                @if(Auth::user()->role === 'admin')

                    ช่วยให้เพื่อนตัวน้อยได้มีบ้าน

                @else

                    พร้อมเปิดบ้านให้เพื่อนตัวน้อยหรือยัง?

                @endif

            </h2>

            <p class="text-orange-50 text-lg mb-8">

                ลองดูสัตว์เลี้ยงที่กำลังรอครอบครัวใหม่
                และอาจพบเพื่อนที่ใช่สำหรับคุณ

            </p>


            <a href="{{ route('pets.index') }}"
               class="inline-flex items-center gap-2
                      px-8 py-4 rounded-full
                      bg-white text-orange-500
                      font-bold text-lg
                      hover:bg-orange-50
                      transition shadow-lg">

                ดูสัตว์ที่รอการรับเลี้ยง

                <span>→</span>

            </a>

        </div>

    </section>


</x-app-layout>