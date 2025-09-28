<?php

namespace Modules\Category\Services;
use Modules\Category\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }
    
    public function store(array $data)
    {
        return Category::create($data);
    }
}
