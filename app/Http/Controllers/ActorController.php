<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ปรับแก้บรรทัดนี้: ดึงข้อมูลนักแสดงพร้อมรายชื่อหนัง (Eager Loading)
        $actors = Actor::with('movies')->get();

        return view('actor.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'gender'  => 'required',
            'cost'    => 'required|numeric',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'belong'  => 'required',
        ]);

        $requestData =$request->all();

        $fileName = time() . $request->file('image')->getClientOriginalName();$path = $request->file('image')->storeAs('images',$fileName, 'public');
        $requestData["image"] = '/storage/' . $path;

        Actor::create($requestData);

        return redirect(route('actor.index'))->with('flash_message', 'Actor Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        return view('actor.edit', ['actor' => $actor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor$actor)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'gender'  => 'required',
            'cost'    => 'required|numeric',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'belong'  => 'required',
        ]);

        if ($request->hasFile('image')) {
            // แนบรูปใหม่ -> ลบรูปเก่าออกก่อน
            $imageRemovePath = str_replace('/storage/images/', '',$request->input('oldimage'));
            Storage::disk('public')->delete('images/' . $imageRemovePath);

            $requestData = $request->all();$fileName = time() . $request->file('image')->getClientOriginalName();$path = $request->file('image')->storeAs('images',$fileName, 'public');
            $requestData["image"] = '/storage/' . $path;

            $actor->update($requestData);
        } else {
            // ไม่ได้แนบรูปใหม่
            $requestData =$request->all();
            $actor->update($requestData);
        }

        return redirect('actor')->with('flash_message', 'Actor updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        if ($actor->image) {
            $path = 'images/' . basename($actor->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $actor->delete();

return redirect(route('actor.index'))->with('success', 'Actor deleted Successfully');
    }
}