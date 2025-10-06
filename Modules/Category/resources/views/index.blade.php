@extends('layouts.master')
@section('content')

<div class="container my-5">
    <h2 class="mb-3">Category List</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    <div class="my-3">
        <input type="text" id="search" class="form-control m-auto text-center w-25" data-url="{{ route('categories.search') }}" placeholder="Search category...">
        <ul id="search-results" class="list-group mt-2" style="max-height:200px; overflow-y:scroll;"></ul>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{ $dataTable->table(['class' => 'table table-bordered table-striped'], true) }}
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush