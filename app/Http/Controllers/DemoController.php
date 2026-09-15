<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
        $demos = Demo::all();
        return view('demo.index', compact('demos'));
    }
}
