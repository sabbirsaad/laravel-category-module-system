@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control">
            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug" class="form-control">
            @error('slug') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
            @error('image') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
            <div><small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</small></div>
        </div>

        <div class="mb-3">
            <label for="is_parent" class="form-label">Is parent</label>
            <select name="is_parent" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
