<?php

use App\Http\Controllers\Member\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //blog route
    // Route::get('/member/blog',[BlogController::class, 'index']);
    // Route::get('/member/blog/{post}/edit',[BlogController::class, 'edit']);

    Route::resource('/member/blogs',BlogController::class)->names([
        'index' => 'member.blogs.index',
        'edit'=>'member.blogs.edit'
    ]);
});

require __DIR__.'/auth.php';
