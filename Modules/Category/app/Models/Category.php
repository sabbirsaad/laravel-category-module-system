<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["name","slug","image","is_parent"];
    
    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

}
