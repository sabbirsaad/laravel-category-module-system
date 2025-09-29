@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Category List</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Is Parent</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->is_parent ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure want to delete this category?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No categories found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
