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
Route::get('/tickets/view/{ticket}', [TicketController::class,'show'])->middleware(['auth', 'verified'])->name('user.ticket.show');
Route::post('/tickets/view/{ticket}/comment', [TicketController::class,'post_comment'])->middleware(['auth', 'verified'])->name('user.ticket.comment');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/support', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('backend.dashboard.index');
});

require __DIR__.'/auth.php';
