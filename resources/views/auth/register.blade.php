<x-guest-layout>

    <!-- พื้นหลัง -->
    <div class="min-h-screen bg-orange-50 flex items-center justify-center px-4 py-8">

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
                    สมัครสมาชิกเพื่อเริ่มต้นการรับสัตว์ไปเลี้ยง
                </p>

            </div>


            <!-- กล่องสมัครสมาชิก -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">

                <!-- หัวข้อ -->
                <div class="text-center mb-6">

                    <h2 class="text-2xl font-bold text-gray-800">
                        สมัครสมาชิก
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        กรุณากรอกข้อมูลเพื่อสร้างบัญชี
                    </p>

                </div>


                <form method="POST" action="{{ route('register') }}">

                    @csrf


                    <!-- Name -->
                    <div>

                        <x-input-label
                            for="name"
                            :value="__('ชื่อ-นามสกุล')"
                        />

                        <x-text-input
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="กรอกชื่อ-นามสกุล"
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Phone -->
                    <div class="mt-4">

                        <x-input-label
                            for="phone"
                            :value="__('เบอร์โทรศัพท์')"
                        />

                        <x-text-input
                            id="phone"
                            class="block mt-1 w-full"
                            type="tel"
                            name="phone"
                            :value="old('phone')"
                            required
                            autocomplete="tel"
                            placeholder="กรอกเบอร์โทรศัพท์"
                        />

                        <x-input-error
                            :messages="$errors->get('phone')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Address -->
                    <div class="mt-4">

                        <x-input-label
                            for="address"
                            :value="__('ที่อยู่')"
                        />

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            required
                            autocomplete="street-address"
                            placeholder="กรอกที่อยู่"
                            class="block mt-1 w-full border-gray-300
                                   focus:border-orange-500
                                   focus:ring-orange-500
                                   rounded-md shadow-sm"
                        >{{ old('address') }}</textarea>

                        <x-input-error
                            :messages="$errors->get('address')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Experience -->
                    <div class="mt-4">

                        <x-input-label
                            for="experience"
                            :value="__('ประสบการณ์ในการเลี้ยงสัตว์')"
                        />

                        <textarea
                            id="experience"
                            name="experience"
                            rows="3"
                            required
                            placeholder="เช่น เคยเลี้ยงสุนัขและแมวมาก่อน"
                            class="block mt-1 w-full border-gray-300
                                   focus:border-orange-500
                                   focus:ring-orange-500
                                   rounded-md shadow-sm"
                        >{{ old('experience') }}</textarea>

                        <x-input-error
                            :messages="$errors->get('experience')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Reason -->
                    <div class="mt-4">

                        <x-input-label
                            for="reason"
                            :value="__('เหตุผลที่ต้องการรับสัตว์ไปเลี้ยง')"
                        />

                        <textarea
                            id="reason"
                            name="reason"
                            rows="3"
                            required
                            placeholder="เช่น ต้องการมีสัตว์เลี้ยงเป็นเพื่อนและสามารถดูแลได้"
                            class="block mt-1 w-full border-gray-300
                                   focus:border-orange-500
                                   focus:ring-orange-500
                                   rounded-md shadow-sm"
                        >{{ old('reason') }}</textarea>

                        <x-input-error
                            :messages="$errors->get('reason')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Email Address -->
                    <div class="mt-4">

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
                            autocomplete="new-password"
                            placeholder="กรอกรหัสผ่าน"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    <!-- Confirm Password -->
                    <div class="mt-4">

                        <x-input-label
                            for="password_confirmation"
                            :value="__('ยืนยันรหัสผ่าน')"
                        />

                        <x-text-input
                            id="password_confirmation"
                            class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="กรอกรหัสผ่านอีกครั้ง"
                        />

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />

                    </div>


                    <!-- ปุ่ม -->
                    <div class="flex items-center justify-between mt-6">

                        <!-- กลับไป Login -->
                        <a
                            class="underline text-sm text-gray-600
                                   hover:text-orange-600
                                   rounded-md
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-offset-2
                                   focus:ring-orange-500"
                            href="{{ route('login') }}"
                        >
                            ← กลับเข้าสู่ระบบ
                        </a>


                        <!-- Register Button -->
                        <x-primary-button
                            class="ms-4 bg-orange-500
                                   hover:bg-orange-600
                                   focus:bg-orange-600
                                   active:bg-orange-700"
                        >
                            🐾 สมัครสมาชิก
                        </x-primary-button>

                    </div>

                </form>

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