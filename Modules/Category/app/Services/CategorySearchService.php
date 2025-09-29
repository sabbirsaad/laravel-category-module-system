<?php

namespace Modules\Category\Services;
use Modules\Category\Models\Category;

class CategorySearchService
{
    
    public function search(?string $keyword)
    {
        $results = Category::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('slug', 'like', "%{$keyword}%");
            })
            ->get(['id', 'name', 'slug']);

        return $results;
    }
}
