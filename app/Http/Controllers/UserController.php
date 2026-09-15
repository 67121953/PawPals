<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // หน้าแบบฟอร์มขอรับเลี้ยง
    public function createAdoptionForm(Request $request)
    {
        $pets = Pet::where('adoption_status', 'available')->get();

        $selectedPet = null;

        if ($request->filled('pet_id')) {
            $selectedPet = Pet::where('id', $request->pet_id)
                ->where('adoption_status', 'available')
                ->firstOrFail();
        }

        // ดึงข้อมูล User ที่ล็อกอินอยู่เพื่อนำไปพรีฟิลล์ (Pre-fill) ในฟอร์ม
        $user = Auth::user();

        return view(
            'adoption.create',
            compact('pets', 'selectedPet', 'user')
        );
    }

    // บันทึกข้อมูลคำขอรับเลี้ยง
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => [
                'required',
                'exists:pets,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'address' => [
                'required',
                'string',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'experience' => [
                'required',
                'string',
                'in:yes,no',
            ],

            'reason' => [
                'required',
                'string',
            ],
        ]);

        // ตรวจสอบว่าน้องยังอยู่ในสถานะกำลังหาบ้าน
        $pet = Pet::where('id', $validated['pet_id'])
            ->where('adoption_status', 'available')
            ->first();

        if (!$pet) {
            return redirect()
                ->route('pets.index')
                ->with(
                    'error',
                    'น้องตัวนี้อยู่ระหว่างการรับเลี้ยงหรือมีบ้านแล้ว'
                );
        }

        // เพิ่ม user_id ของผู้ล็อกอินเข้าไปในข้อมูลก่อนบันทึก
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending'; // กำหนดสถานะคำขอรับเลี้ยง

        // บันทึกคำขอรับเลี้ยง
        $adoption = Adoption::create($validated);

        // เปลี่ยนสถานะสัตว์เลี้ยงเป็นอยู่ระหว่างการรับเลี้ยง
        $pet->adoption_status = 'pending';
        $pet->save();

        // ไปหน้าหลังส่งคำขอ
        return redirect()
            ->route('adoption.confirmation', ['adoption' => $adoption->id])
            ->with('success', 'ส่งคำขอรับเลี้ยงเรียบร้อยแล้ว');
    }

    // หน้ายืนยันคำขอรับเลี้ยง
    public function confirmation(Adoption $adoption)
    {
        // ป้องกันไม่ให้ User คนอื่นแอบเข้ามาดูใบยืนยันของคนอื่น (ดูได้เฉพาะเจ้าของคำขอ หรือ Admin)
        if ($adoption->user_id && $adoption->user_id !== Auth::id()) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        $adoption->load('pet');

        return view(
            'adoption.confirmation',
            compact('adoption')
        );
    }
}