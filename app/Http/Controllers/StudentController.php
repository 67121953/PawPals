<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
{
    $students = [
        ['id' => '6511001', 'name' => 'สมชาย ใจดี',     'score' => 85],
        ['id' => '6511002', 'name' => 'สมหญิง รักเรียน', 'score' => 72],
        ['id' => '6511003', 'name' => 'อนุชา ตั้งใจ',    'score' => 45],
        ['id' => '6511004', 'name' => 'พิมพ์ใจ ขยัน',    'score' => 91],
        ['id' => '6511005', 'name' => 'วีระ สู้ชีวิต',    'score' => 60],
    ];

    $totalScore = array_sum(array_column($students, 'score'));
    $averageScore = $totalScore / count($students);

    return view('students.index', compact('students', 'averageScore'));
}

}
