<?php

use App\Http\Controllers\AnimatorController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\CallToActionController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WinnerController;
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

Route::get('/', [AuditorController::class, 'index'])->name('auditor.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'auth.auditor'])->group(function () {
    Route::middleware('chat.enabled')->group(function () {
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    });
    Route::post('/answers', [AnswerController::class, 'store'])->name('answers.store');
});

Route::middleware(['auth', 'auth.animator'])->group(function () {
    Route::get('/dashboard', [AnimatorController::class, 'index'])->name('animator.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::post('/interactions/cta', [CallToActionController::class, 'store'])->name('interactions.cta.store');
    Route::post('/interactions/quick_click', [InteractionController::class, 'store'])->name('interactions.quick_click.store');
    Route::post('/interactions/survey', [InteractionController::class, 'store'])->name('interactions.survey.store');
    Route::post('/interactions/mcq', [InteractionController::class, 'store'])->name('interactions.mcq.store');
    Route::post('/interactions/audio', [InteractionController::class, 'store'])->name('interactions.audio.store');
    Route::post('/interactions/video', [InteractionController::class, 'store'])->name('interactions.video.store');
    Route::post('/interactions/picture', [InteractionController::class, 'store'])->name('interactions.picture.store');

    Route::post('/interactions/winner/random', [WinnerController::class, 'generateRandomList'])->name('interactions.winner.random');
    Route::post('/interactions/winner/replace', [WinnerController::class, 'generate1Random'])->name('interactions.winner.replace');
    Route::post('/interactions/winner/fastest', [WinnerController::class, 'generateFastestList'])->name('interactions.winner.fastest');
    Route::post('/interactions/winner/confirm', [WinnerController::class, 'store'])->name('interactions.winner.confirm');
});

require __DIR__ . '/auth.php';
