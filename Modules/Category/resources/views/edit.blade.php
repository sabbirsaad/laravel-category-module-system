@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control">
            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" id="slug" name="slug" value="{{ $category->slug }}" class="form-control">
            @error('slug') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label>Is Parent</label>
            <select name="is_parent" class="form-control">
                <option value="1" {{ $category->is_parent ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$category->is_parent ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
