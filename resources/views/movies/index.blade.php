@extends('movies.layout')

@section('title', 'MOVIE GARAGE - Racing List')

@section('content')
<div class="container mt-4">
    <!-- หัวข้อและปุ่ม Create ซิ่งๆ -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="racing-title m-0">🎬 MOVIE GARAGE LIST</h2>
        <a href="{{ route('movie.create') }}" class="btn btn-primary px-4 py-2">
            + ADD NEW MOVIE
        </a>
    </div>

    <!-- ตารางดีไซน์ Racing -->
    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">RELEASE YEAR</th>
                    <th scope="col">LEAD ACTOR</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $item)
                <tr>
                    <td class="fw-bold text-muted">#{{ $item->id }}</td>
                    <td class="fw-bold text-white fs-6 text-start">
                        🎬 {{ $item->title }}
                    </td>
                    <td>
                        <span class="badge bg-dark border border-secondary text-info">
                            📅 {{ $item->release_year }}
                        </span>
                    </td>
                    <td>
                        @if($item->actor)
                            <span class="badge bg-secondary text-white">
                                👤 {{ $item->actor->name }}
                            </span>
                        @else
                            <small class="text-muted fst-italic">N/A</small>
                        @endif
                    </td>

                    {{-- ปุ่ม Edit --}}
                    <td>
                        <a href="{{ route('movie.edit', $item->id) }}" class="btn btn-primary btn-sm px-3">
                            Edit
                        </a>
                    </td>

                    {{-- ปุ่ม Delete --}}
                    <td>
                        <form action="{{ route('movie.destroy', $item->id) }}" method="POST" onsubmit="return confirm('ต้องการลบหนังเรื่องนี้ใช่หรือไม่?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection