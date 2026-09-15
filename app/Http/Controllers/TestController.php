<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }
    public function showData()
    {
        $data = ['name' => 'Aom', 'address' => 'Chiang Mai'];
        $age = 18;
        //return view('test.showData')->with('data', $data);
        return view('test.showData',compact('data','age'));
    }
}
