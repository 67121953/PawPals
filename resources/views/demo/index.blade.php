@extends('demo.layout')
@section('title', 'แสดงข้อมูลในตาราง Demo')
@section('content')
    <table class="table table-striped table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($demos as $demo)
            <tr>
                <td>{{ $demo->id }}</td>
                <td>{{ $demo->name }}</td>
                <td>{{ $demo->detail }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection