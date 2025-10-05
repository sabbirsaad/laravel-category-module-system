@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Category List</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    <div class="my-3">
        <input type="text" id="search" class="form-control m-auto text-center w-25" data-url="{{ route('categories.search') }}" placeholder="Search category...">
        <ul id="search-results" class="list-group mt-2"></ul>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
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
                    <td>
                        @if($category->image)
                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="rounded"
                            style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                        <div class="bg-info rounded d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-image text-white">📷</i>
                        </div>
                        @endif
                    </td>
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
    {{ $categories->links() }}
</div>
@endsection
