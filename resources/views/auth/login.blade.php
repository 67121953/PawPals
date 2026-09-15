<x-guest-layout>

    <!-- พื้นหลัง -->
    <div class="min-h-screen bg-orange-50 flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- หัวระบบ -->
            <div class="text-center mb-6">

                <div class="mx-auto w-20 h-20 bg-orange-100 rounded-full
                            flex items-center justify-center text-4xl">
                    🐾
                </div>

                <h1 class="mt-4 text-3xl font-bold text-gray-800">
                    PET ADOPTION
                </h1>

                <p class="mt-2 text-gray-600">
                    ระบบรับสัตว์ไปเลี้ยง
                </p>

                <p class="mt-1 text-sm text-gray-400">
                    ค้นหาเพื่อนตัวใหม่และมอบบ้านที่อบอุ่นให้พวกเขา
                </p>

            </div>


            <!-- กล่อง Login -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">

                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />


                <!-- หัวข้อ -->
                <div class="text-center mb-6">

                    <h2 class="text-2xl font-bold text-gray-800">
                        เข้าสู่ระบบ
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        กรุณากรอกข้อมูลเพื่อเข้าสู่ระบบ
                    </p>

                </div>


                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <!-- Email Address -->
                    <div>

                        <x-input-label
                            for="email"
                            :value="__('อีเมล')"
                        />

                        <x-text-input
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="กรอกอีเมล"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Password -->
                    <div class="mt-4">

                        <x-input-label
                            for="password"
                            :value="__('รหัสผ่าน')"
                        />

                        <x-text-input
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="กรอกรหัสผ่าน"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Remember Me -->
                    <div class="block mt-4">

                        <label
                            for="remember_me"
                            class="inline-flex items-center"
                        >

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300
                                       text-orange-600
                                       shadow-sm
                                       focus:ring-orange-500"
                                name="remember"
                            >

                            <span class="ms-2 text-sm text-gray-600">
                                จดจำการเข้าสู่ระบบ
                            </span>

                        </label>

                    </div>


                    <!-- ปุ่ม Login -->
                    <div class="flex items-center justify-end mt-6">

                        @if (Route::has('password.request'))

                            <a
                                class="underline text-sm text-gray-600
                                       hover:text-orange-600
                                       rounded-md
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-offset-2
                                       focus:ring-orange-500"
                                href="{{ route('password.request') }}"
                            >
                                ลืมรหัสผ่าน?
                            </a>

                        @endif


                        <x-primary-button
                            class="ms-3 bg-orange-500
                                   hover:bg-orange-600
                                   focus:bg-orange-600
                                   active:bg-orange-700"
                        >
                            🐾 เข้าสู่ระบบ
                        </x-primary-button>

                    </div>

                </form>


                <!-- สมัครสมาชิก -->
                @if (Route::has('register'))

                    <div class="text-center mt-6 pt-5 border-t">

                        <span class="text-sm text-gray-500">
                            ยังไม่มีบัญชี?
                        </span>

                        <a
                            href="{{ route('register') }}"
                            class="text-sm font-semibold
                                   text-orange-500
                                   hover:text-orange-700"
                        >
                            สมัครสมาชิก
                        </a>

                    </div>

                @endif


                <!-- กลับหน้าหลัก -->
                <div class="text-center mt-4">

                    <a
                        href="{{ url('/') }}"
                        class="text-sm text-gray-500
                               hover:text-orange-600"
                    >
                        ← กลับหน้าหลัก
                    </a>

                </div>

            </div>


            <!-- ข้อความด้านล่าง -->
            <div class="text-center mt-6">

                <div class="text-2xl">
                    🐶 🐱 🐰
                </div>

                <p class="text-xs text-gray-400 mt-2">
                    มอบบ้านที่อบอุ่นให้กับสัตว์ที่รอการรับเลี้ยง
                </p>

            </div>

        </div>

    </div>

</x-guest-layout>