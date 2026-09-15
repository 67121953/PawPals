<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Support\Facades\DB;

class AdminAdoptionController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with('pet')
            ->latest()
            ->paginate(10);

        return view('admin.adoptions.index', compact('adoptions'));
    }

    public function show(Adoption $adoption)
    {
        $adoption->load('pet');

        return view('admin.adoptions.show', compact('adoption'));
    }

    public function approve(Adoption $adoption)
    {
        if ($adoption->status !== 'pending') {
            return back()->with('error', 'คำขอนี้ถูกจัดการไปแล้ว');
        }

        $pet = $adoption->pet;

        if (!$pet || $pet->adoption_status !== 'pending') {
            return back()->with('error', 'สถานะสัตว์เลี้ยงไม่ถูกต้อง');
        }

        DB::transaction(function () use ($adoption, $pet) {
            $adoption->update([
                'status' => 'approved',
            ]);

            $pet->update([
                'adoption_status' => 'adopted',
            ]);
        });

        return redirect()
            ->route('admin.adoptions.show', $adoption)
            ->with('success', 'อนุมัติคำขอรับเลี้ยงเรียบร้อยแล้ว');
    }

    public function reject(Adoption $adoption)
    {
        if ($adoption->status !== 'pending') {
            return back()->with('error', 'คำขอนี้ถูกจัดการไปแล้ว');
        }

        $pet = $adoption->pet;

        DB::transaction(function () use ($adoption, $pet) {
            $adoption->update([
                'status' => 'rejected',
            ]);

            if ($pet && $pet->adoption_status === 'pending') {
                $pet->update([
                    'adoption_status' => 'available',
                ]);
            }
        });

        return redirect()
            ->route('admin.adoptions.show', $adoption)
            ->with('success', 'ปฏิเสธคำขอรับเลี้ยงเรียบร้อยแล้ว');
    }
}