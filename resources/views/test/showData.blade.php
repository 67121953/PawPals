@extends('test.layout')
@section('title')
    showdata
@endsection
@section('content')
    <h1>Welcome,{{$data['name']}} to Laravel </h1>
    <p>your address is {{$data['address']}}</p>
    
    @if ($age >= 18)
        <p>อายุของคุณคือ {{$age}} ผู้ใหญ่</p>
    @elseif ($age >= 13)
        <p>อายุของคุณคือ {{$age}} วัยรุ่น</p>
    @else
        <p>อายุของคุณคือ {{$age}} เด็ก</p>
        
    @endif
@endsection