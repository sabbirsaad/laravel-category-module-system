<?php

namespace Modules\Category\Services;
use Modules\Category\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryService
{
    public function getAll()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->uploadImage($data['image']);
        }
        
        return Category::create($data);
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);
        if (isset($data['image'])) {
            // delete old image if exists
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                File::delete(public_path('uploads/categories/' . $category->image));
            }
            $data['image'] = $this->uploadImage($data['image']);
        }
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // If category has an image, delete it from storage
        if ($category->image) {
            $imagePath = public_path('uploads/categories/' . $category->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        return $category->delete();
    }

    protected function uploadImage($file)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/categories'), $filename);
        return $filename;
    }
}
