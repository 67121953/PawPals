@extends('demo.layout')

@section('title','Product')

@section('content')

<table class="table table-striped table-hover mt-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price,2) }}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="2" class="text-end">
                <strong>Sum Price</strong>
            </td>
            <td>
                <strong>{{ number_format($sumPrice,2) }}</strong>
            </td>
        </tr>

    </tbody>
</table>

@endsection