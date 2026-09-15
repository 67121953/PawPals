@extends('actor.layout')

@section('title', 'ACTOR GARAGE - Racing List')

@section('content')
<div class="container mt-4">
    <!-- หัวข้อและปุ่ม Create ซิ่งๆ -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="racing-title m-0">🏎️ ACTOR GARAGE LIST</h2>
        <a href="{{ route('actor.create') }}" class="btn btn-primary px-4 py-2">
            + CREATE NEW ACTOR
        </a>
    </div>

    <!-- ตารางดีไซน์ Racing -->
    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">GENDER</th>
                    <th scope="col">COST</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">BELONG</th>
                    <th scope="col">MOVIES</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATED AT</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actors as $item)
                <tr>
                    <td class="fw-bold text-muted">#{{ $item->id }}</td>
                    <td class="fw-bold text-white fs-6">{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $item->gender }}</span>
                    </td>
                    <td class="text-warning fw-bold">฿{{ number_format($item->cost) }}</td>
                    <td>
                        <img src="{{ asset($item->image) }}" width="50" height="50" class="img-thumbnail" style="object-fit: cover;">
                    </td>
                    <td><span class="badge bg-dark border border-secondary">{{ $item->belong }}</span></td>
                    
                    <td class="text-start">
                        @if ($item->movies->isNotEmpty())
                            <ul class="mb-0 ps-3">
                                @foreach ($item->movies as $movie)
                                    <li class="text-info fw-bold">
                                        🎬 {{ $movie->title }} <span class="text-white-50">({{ $movie->release_year }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <small class="text-muted fst-italic">No movies found.</small>
                        @endif
                    </td>

                    {{-- วันที่สร้าง --}}
                    <td>
                        <small class="text-white-50">
                            {{ $item->created_at ? $item->created_at->format('Y-m-d H:i') : '-' }}
                        </small>
                    </td>

                    {{-- วันที่อัปเดต --}}
                    <td>
                        <small class="text-white-50">
                            {{ $item->updated_at ? $item->updated_at->format('Y-m-d H:i') : '-' }}
                        </small>
                    </td>

                    {{-- ปุ่ม Edit --}}
                    <td>
                        <a href="{{ route('actor.edit', $item->id) }}" class="btn btn-primary btn-sm px-3">
                            Edit
                        </a>
                    </td>

                    {{-- ปุ่ม Delete --}}
                    <td>
                        <form action="{{ route('actor.destroy', $item->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบนักแสดงคนนี้?')">
                            @csrf
                            @method("DELETE")
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