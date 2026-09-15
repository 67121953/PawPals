@extends('movies.layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Movie</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('movie.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title (ชื่อเรื่อง)</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="release_year" class="form-label">Release Year (ปีที่ฉาย)</label>
                    <input type="number" name="release_year" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="actor_id" class="form-label">Select Actor (เลือกนักแสดงนำ)</label>
                    <select name="actor_id" class="form-control" required>
                        <option value="">-- เลือกนักแสดงนำ --</option>
                        @foreach($actors as $actor)
                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('movie.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection