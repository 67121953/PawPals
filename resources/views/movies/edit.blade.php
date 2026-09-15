@extends('movies.layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit Movie (แก้ไขข้อมูลภาพยนตร์)</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('movie.update', $movie->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title (ชื่อเรื่อง)</label>
                    <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="release_year" class="form-label">Release Year (ปีที่ฉาย)</label>
                    <input type="number" name="release_year" class="form-control" value="{{ $movie->release_year }}" required>
                </div>

                <div class="mb-3">
                    <label for="actor_id" class="form-label">Select Actor (เลือกนักแสดงนำ)</label>
                    <select name="actor_id" class="form-control" required>
                        <option value="">-- เลือกนักแสดงนำ --</option>
                        @foreach($actors as $actor)
                            <option value="{{ $actor->id }}" {{ $movie->actor_id == $actor->id ? 'selected' : '' }}>
                                {{ $actor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update (บันทึกการแก้ไข)</button>
                <a href="{{ route('movie.index') }}" class="btn btn-secondary">Back (ยกเลิก)</a>
            </form>
        </div>
    </div>
</div>
@endsection