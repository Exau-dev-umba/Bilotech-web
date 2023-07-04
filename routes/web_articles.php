<?php 
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;


Route::get('/tags', [TagController::class, 'index'])->name('tag.index');

    
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/tags', [TagController::class, 'store'])->name('tag.store');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});
    



    