<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->get('/dashboard', function () {
    $role = Auth::user()->role;
        if($role === 'admin'){
            return redirect()->route('admin.book.index');
        } else {
            return redirect()->route('my.book.index');
        }
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth','role:admin'])->group(function(){
    Route::resource('/admin/book',AdminBookController::class)->except('show')->names([
            'index' => 'admin.book.index',
            'create' => 'admin.book.create',
            'store' => 'admin.book.store',
            'edit' => 'admin.book.edit',
            'update' => 'admin.book.update',
            'destroy' => 'admin.book.destroy',
        ]);
    Route::get('/admin/book/filter', [AdminBookController::class, 'filter'])->name('admin.book.filter');
    Route::get('/admin/book/report', [AdminBookController::class, 'export'])->name('admin.book.export');
    Route::resource('admin/category', AdminCategoryController::class)->except('show','edit','create')->names([
            'index' => 'admin.category.index',
            'store' => 'admin.category.store',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy',
    ]);

    

});

Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/my/book/filter', [UserBookController::class, 'filter'])->name('my.book.filter');
    Route::resource('my/book',UserBookController::class)->except('show')->names([
        'index' => 'my.book.index',
        'create' => 'my.book.create',
        'store' => 'my.book.store',
        'edit' => 'my.book.edit',
        'update' => 'my.book.update',
        'destroy' => 'my.book.destroy',
    ]);
});

require __DIR__.'/auth.php';
