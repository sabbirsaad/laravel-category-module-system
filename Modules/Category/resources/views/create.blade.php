<x-category::layouts.master>
<div class="container mt-4">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
            @error('name') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
            @error('slug') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-3">
            <label>Is Parent</label>
            <select name="is_parent" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</x-category::layouts.master>
