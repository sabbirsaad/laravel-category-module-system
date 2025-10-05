<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $categoryId = $this->route('category');
        return [
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|max:255|unique:categories,slug,' . $categoryId,
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_parent' => 'nullable|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
