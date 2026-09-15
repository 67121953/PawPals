<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Actor;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('actor')->get();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $actors = Actor::all();
        return view('movies.create', compact('actors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'release_year' => 'required|numeric',
            'actor_id'     => 'required|exists:actor,id',
        ]);

        Movie::create($request->all());

        return redirect()->route('movie.index')->with('success', 'Movie Added Successfully');
    }

    // แสดงหน้าฟอร์มแก้ไขข้อมูลหนัง
    public function edit(Movie $movie)
    {
        $actors = Actor::all();
        return view('movies.edit', compact('movie', 'actors'));
    }

    // อัปเดตข้อมูลหนังลงฐานข้อมูล
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title'        => 'required',
            'release_year' => 'required|numeric',
            'actor_id'     => 'required|exists:actor,id',
        ]);

        $movie->update($request->all());

        return redirect()->route('movie.index')->with('success', 'Movie Updated Successfully');
    }

    // ลบข้อมูลหนัง
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movie.index')->with('success', 'Movie Deleted Successfully');
    }
}