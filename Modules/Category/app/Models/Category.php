<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name","slug","is_parent"];

}
