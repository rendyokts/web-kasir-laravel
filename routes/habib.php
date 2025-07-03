<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\MasterCategoryController;

//Master Category
Route::prefix('master_categori')->group(function () {
    Route::get('/', [MasterCategoryController::class, 'index'])->name('master_category.index');
    Route::get('/add_category', [MasterCategoryController::class, 'createCategory'])->name('master_category.add_category');
    Route::post('/save_category', [MasterCategoryController::class, 'saveCategory'])->name('master_category.save');
    Route::get('/edit_category/{id}', [MasterCategoryController::class, 'editCategory'])->name('master_category.edit');
    Route::delete('/delete_category/{id}', [MasterCategoryController::class, 'deleteCategory'])->name('master_category.delete');
});
