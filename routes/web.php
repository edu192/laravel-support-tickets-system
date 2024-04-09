<?php

use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//File Download Route
Route::get('/download/{file}', function (\App\Models\File $file){
    return Storage::download('public/uploads/'.$file->name);
})->name('download.file');
//
Route::get('/tickets/view/{ticket}', [TicketController::class,'show'])->middleware(['auth', 'verified'])->name('user.ticket.show');
Route::post('/tickets/view/{ticket}/comment', [TicketController::class,'post_comment'])->middleware(['auth', 'verified'])->name('user.ticket.comment');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['backend']],function (){
        Route::get('/support', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('backend.dashboard.index');
        Route::get('/support/tickets', [\App\Http\Controllers\Backend\TicketController::class, 'index'])->name('backend.ticket.index');
        Route::get('/support/assigned-tickets', [\App\Http\Controllers\Backend\TicketController::class, 'assigned_tickets'])->name('backend.ticket.assigned');
        Route::get('/support/tickets/{ticket}', [\App\Http\Controllers\Backend\TicketController::class, 'view'])->name('backend.ticket.comments');
        Route::post('/support/tickets/{ticket}/post-comment', [\App\Http\Controllers\Backend\TicketController::class, 'post_comment'])->name('backend.ticket.post-comment');
        Route::group(['middleware' => 'backend.admin'],function (){
            Route::get('/support/users', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('backend.user.index');
            Route::get('/support/departments', [\App\Http\Controllers\Backend\DepartmentController::class, 'index'])->name('backend.department.index');
            Route::get('/support/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('backend.category.index');
        });

    });
});

require __DIR__.'/auth.php';
