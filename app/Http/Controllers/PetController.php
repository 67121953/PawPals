<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('age')) {
            switch ($request->age) {
                case 'young':
                    $query->where('age_years', '<', 1);
                    break;

                case 'adult':
                    $query->whereBetween('age_years', [1, 7]);
                    break;

                case 'senior':
                    $query->where('age_years', '>', 7);
                    break;
            }
        }

        if ($request->filled('status')) {
            $query->where('adoption_status', $request->status);
        }

        $pets = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pets.index', compact('pets'));
    }


    public function createAdoptionForm(Request $request)
    {
        $pets = Pet::where('adoption_status', 'available')->get();

        $selectedPet = null;

        if ($request->filled('pet_id')) {
            $selectedPet = Pet::where('id', $request->pet_id)
                ->where('adoption_status', 'available')
                ->firstOrFail();
        }

        return view('adoption.create', compact('pets', 'selectedPet'));
    }


    public function create()
    {
        return view('pets.create');
    }


    /**
     * บันทึกสัตว์เลี้ยงใหม่
     */
    public function store(Request $request)
    {
        $validated = $this->validatePetRequest($request);

        $data = $this->preparePetData($request, $validated);

        /*
         * Upload รูปภาพ
         * รองรับ JPG / JPEG / PNG
         * สูงสุด 20 MB
         */
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            if ($image->isValid()) {
                $data['image'] = $image->store('pets', 'public');
            }
        }

        Pet::create($data);

        return redirect()
            ->route('pets.index')
            ->with('success', 'บันทึกข้อมูลสัตว์เลี้ยงเรียบร้อยแล้ว!');
    }


    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }


    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }


    /**
     * แก้ไขข้อมูลสัตว์เลี้ยง
     */
    public function update(Request $request, Pet $pet)
    {
        $validated = $this->validatePetRequest($request);

        $data = $this->preparePetData($request, $validated);

        /*
         * ถ้ามีการ Upload รูปใหม่
         */
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            if ($image->isValid()) {

                /*
                 * ลบรูปเก่าก่อน
                 */
                if (
                    !empty($pet->image) &&
                    Storage::disk('public')->exists($pet->image)
                ) {
                    Storage::disk('public')->delete($pet->image);
                }

                /*
                 * บันทึกรูปใหม่
                 */
                $data['image'] = $image->store('pets', 'public');
            }
        }

        $pet->update($data);

        return redirect()
            ->route('pets.index')
            ->with('success', 'แก้ไขข้อมูลสัตว์เลี้ยงเรียบร้อยแล้ว!');
    }


    /**
     * ลบสัตว์เลี้ยง
     */
    public function destroy(Pet $pet)
    {
        /*
         * ลบรูปภาพของสัตว์เลี้ยงด้วย
         */
        if (
            !empty($pet->image) &&
            Storage::disk('public')->exists($pet->image)
        ) {
            Storage::disk('public')->delete($pet->image);
        }

        $pet->delete();

        return redirect()
            ->route('pets.index')
            ->with('success', 'ลบข้อมูลสัตว์เลี้ยงเรียบร้อยแล้ว!');
    }


    /**
     * สลับสถานะการรับเลี้ยง
     *
     * available → adopted
     * adopted   → available
     */
    public function toggleAdopt(Pet $pet)
    {
        $newStatus = $pet->adoption_status === 'available'
            ? 'adopted'
            : 'available';

        $pet->update([
            'adoption_status' => $newStatus
        ]);

        $statusText = $newStatus === 'adopted'
            ? 'ถูกรับเลี้ยงแล้ว'
            : 'พร้อมสำหรับการรับเลี้ยง';

        return redirect()
            ->back()
            ->with(
                'success',
                "อัปเดตสถานะของ {$pet->name} เป็น \"{$statusText}\" เรียบร้อยแล้ว!"
            );
    }


    /**
     * ตรวจสอบข้อมูลสัตว์เลี้ยง
     */
    private function validatePetRequest(Request $request): array
    {
        return $request->validate([

            'name' => 'required|string|max:255',

            'type' => 'required|in:Dog,Cat',

            'age' => 'required|numeric|min:0',

            'age_unit' => 'required|in:years,months',

            'weight_lbs' => 'required|numeric|min:0',

            'breed' => 'required|string|max:255',

            'gender' => 'required|in:Male,Female',

            'location' => 'required|string|max:255',

            'about' => 'required|string',

            'adoption_status' => 'required|in:available,pending,adopted',

            'social_level' => 'required|integer|min:1|max:5',

            'talkative_level' => 'required|integer|min:1|max:5',

            'active_level' => 'required|integer|min:1|max:5',

            /*
             * รูปภาพ
             * JPG / JPEG / PNG
             * ขนาดสูงสุด 20 MB
             */
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
        ]);
    }


    /**
     * เตรียมข้อมูลก่อนบันทึกลง Database
     */
    private function preparePetData(
        Request $request,
        array $validated
    ): array {

        $data = [

            'name' => $validated['name'],

            'type' => $validated['type'],

            'weight_lbs' => $validated['weight_lbs'],

            'breed' => $validated['breed'],

            'gender' => $validated['gender'],

            'location' => $validated['location'],

            'about' => $validated['about'],

            'social_level' => $validated['social_level'],

            'talkative_level' => $validated['talkative_level'],

            'active_level' => $validated['active_level'],

            'adoption_status' => $validated['adoption_status'],
        ];


        /*
         * แปลงอายุเป็นปี
         */
        $ageValue = (float) $validated['age'];

        if ($validated['age_unit'] === 'months') {

            $data['age_years'] = round(
                $ageValue / 12,
                4
            );

        } else {

            $data['age_years'] = $ageValue;
        }


        /*
         * คุณสมบัติสัตว์เลี้ยง
         */
        $attributes = [

            'is_apartment_friendly',

            'is_studio_friendly',

            'is_potty_trained',

            'is_leash_trained',

            'is_people_friendly',

            'is_dog_friendly',

            'is_vaccinated',

            'is_healthy',
        ];


        foreach ($attributes as $attribute) {

            $data[$attribute] = $request->has($attribute);
        }


        return $data;
    }
}