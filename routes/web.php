<?php

use App\Http\Controllers\Animator\DashboardController as AnimatorDashboardController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auditor\DashboardController as AuditorDashboardController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuditorDashboardController::class, 'index'])->name('auditor.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'auth.auditor', HandlePrecognitiveRequests::class])->group(function () {
    Route::post('/messages', [AuditorDashboardController::class, 'storeMessage'])->middleware('chat.enabled')->name('auditor.messages.store');
    Route::post('/answer', [AnswerController::class, 'store'])->name('answer.store');
});

Route::middleware(['auth', 'auth.animator', HandlePrecognitiveRequests::class])->group(function () {
    Route::get('/dashboard', [AnimatorDashboardController::class, 'index'])->name('animator.index');
    Route::post('/dashboard/chat', [AnimatorDashboardController::class, 'updateChatSetting'])->name('animator.chat.update');
    Route::resource('/dashboard/interactions', InteractionController::class)->names([
        'index' => 'animator.interactions.index',
        'show' => 'animator.interactions.show',
        'store' => 'animator.interactions.store',
    ])->only(['index', 'show', 'store']);
});

require __DIR__.'/auth.php';
