<?php

namespace Modules\Category\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true); // e.g. "Smart Phone"

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'is_parent' => $this->faker->boolean(70), // 70% chance it's a parent
        ];
    }
}
