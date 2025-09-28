<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::group(['middleware' => ['web']], function () {
    Route::resource('categories', CategoryController::class);
});
