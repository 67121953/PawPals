<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PawPals - ระบบรับเลี้ยงสัตว์</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

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
</head>

<body class="bg-orange-50 text-gray-800">

    {{-- Navigation --}}
    <nav class="bg-white/95 backdrop-blur-md border-b border-orange-100 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="{{ route('welcome') }}"
                   class="flex items-center gap-2">

                    <span class="text-3xl">🐾</span>

                    <span class="text-2xl font-bold text-orange-500">
                        PawPals
                    </span>

                </a>


                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-8">

                    <a href="{{ route('welcome') }}"
                       class="text-gray-700 hover:text-orange-500 font-medium">
                        หน้าแรก
                    </a>

                    <a href="{{ route('pets.index') }}"
                       class="text-gray-700 hover:text-orange-500 font-medium">
                        สัตว์ที่รอการรับเลี้ยง
                    </a>

                    <a href="{{ route('pet-care') }}"
                       class="text-gray-700 hover:text-orange-500 font-medium">
                        การดูแลสัตว์
                    </a>

                    <a href="{{ route('about-us') }}"
                       class="text-gray-700 hover:text-orange-500 font-medium">
                        เกี่ยวกับเรา
                    </a>

                    <a href="{{ route('contact') }}"
                       class="text-gray-700 hover:text-orange-500 font-medium">
                        ติดต่อเรา
                    </a>

                </div>


                {{-- Login / Register --}}
                <div class="flex items-center gap-3">

                    @auth

                        <a href="{{ route('dashboard') }}"
                           class="px-5 py-2 rounded-full bg-orange-500 text-white font-semibold
                                  hover:bg-orange-600 transition">
                            Dashboard
                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="text-gray-700 hover:text-orange-500 font-medium">
                            เข้าสู่ระบบ
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-5 py-2 rounded-full bg-orange-500 text-gray-700 font-semibold
                                  hover:bg-orange-600 transition">
                            สมัครสมาชิก
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    {{-- Hero Section --}}
    <section class="hero flex items-center">

        <div class="max-w-7xl mx-auto w-full px-6">

            <div class="max-w-2xl">

                <div class="inline-flex items-center gap-2
                            bg-white/90 rounded-full px-5 py-2
                            text-orange-600 font-semibold shadow-sm mb-6">

                    🐾
                    <span>
                        ยินดีต้อนรับสู่ PawPals
                    </span>

                </div>


                <h1 class="hero-title text-gray-800 mb-6">

                    เพื่อนตัวน้อย
                    <br>

                    <span class="text-orange-500">
                        กำลังรอบ้านใหม่
                    </span>

                </h1>


                <p class="text-lg md:text-xl text-gray-600 leading-relaxed mb-8">

                    PawPals คือระบบที่ช่วยเชื่อมต่อระหว่าง
                    สัตว์เลี้ยงที่กำลังรอบ้าน
                    กับคนที่พร้อมมอบความรักและครอบครัวให้พวกเขา

                </p>


                <div class="flex flex-wrap gap-4">

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

                </div>

            </div>

        </div>

    </section>


    {{-- Introduction --}}
    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-14">

                <span class="text-orange-500 font-bold">
                    🐾 PAWPALS
                </span>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-3 mb-4">
                    เพราะทุกชีวิตควรมีบ้าน
                </h2>

                <p class="text-gray-500 text-lg leading-relaxed">
                    เราต้องการช่วยให้สัตว์เลี้ยงที่กำลังรอครอบครัว
                    ได้พบกับคนที่พร้อมดูแลและมอบความรักให้กับพวกเขา
                </p>

            </div>


            {{-- Feature Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


                {{-- Card 1 --}}
                <div class="paw-card bg-orange-50 rounded-3xl p-8">

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

                </div>


                {{-- Card 2 --}}
                <div class="paw-card bg-green-50 rounded-3xl p-8">

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

                </div>


                {{-- Card 3 --}}
                <div class="paw-card bg-purple-50 rounded-3xl p-8">

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

                </div>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="py-20 bg-orange-500">

        <div class="max-w-5xl mx-auto px-6 text-center">

            <div class="text-6xl mb-6">
                🐾
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
                พร้อมเปิดบ้านให้เพื่อนตัวน้อยหรือยัง?
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


    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300">

        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="flex flex-col md:flex-row
                        justify-between items-center gap-5">

                <div class="flex items-center gap-2">

                    <span class="text-2xl">
                        🐾
                    </span>

                    <span class="text-xl font-bold text-white">
                        PawPals
                    </span>

                </div>

                <p class="text-sm text-gray-400">
                    ระบบรับเลี้ยงสัตว์ เพื่อเพื่อนตัวน้อยที่กำลังรอบ้าน
                </p>

                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} PawPals
                </p>

            </div>

        </div>

    </footer>

</body>
</html>