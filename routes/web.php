<?php

use App\Http\Controllers\AnimatorController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WinnerController;
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

    Route::post('/interactions/{interaction}/answers/cta', [AnswerController::class, 'storeCTA'])->name('interactions.answers.cta.store');
    Route::post('/interactions/{interaction}/answers/quick_click', [AnswerController::class, 'storeQuickClick'])->name('interactions.answers.quick_click.store');
    Route::post('/interactions/{interaction}/answers/survey', [AnswerController::class, 'storeSurvey'])->name('interactions.answers.survey.store');
    Route::post('/interactions/{interaction}/answers/mcq', [AnswerController::class, 'storeMCQ'])->name('interactions.answers.mcq.store');
    Route::post('/interactions/{interaction}/answers/audio', [AnswerController::class, 'storeAudio'])->name('interactions.answers.audio.store');
    Route::post('/interactions/{interaction}/answers/video', [AnswerController::class, 'storeVideo'])->name('interactions.answers.video.store');
    Route::post('/interactions/{interaction}/answers/picture', [AnswerController::class, 'storePicture'])->name('interactions.answers.picture.store');
    Route::post('/interactions/{interaction}/answers/text', [AnswerController::class, 'storeText'])->name('interactions.answers.text.store');
});

Route::middleware(['auth', 'auth.animator'])->group(function () {
    Route::get('/dashboard', [AnimatorController::class, 'index'])->name('animator.index');
    Route::post('/endEmission', [AnimatorController::class, 'endEmission'])->name('animator.endEmission');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::middleware([HandlePrecognitiveRequests::class])->group(function () {
        Route::post('/interactions/cta', [InteractionController::class, 'storeCTA'])->name('interactions.cta.store');
        Route::post('/interactions/quick_click', [InteractionController::class, 'storeQuickClick'])->name('interactions.quick_click.store');
        Route::post('/interactions/survey', [InteractionController::class, 'storeSurvey'])->name('interactions.survey.store');
        Route::post('/interactions/mcq', [InteractionController::class, 'storeMCQ'])->name('interactions.mcq.store');
        Route::post('/interactions/audio', [InteractionController::class, 'storeAudio'])->name('interactions.audio.store');
        Route::post('/interactions/video', [InteractionController::class, 'storeVideo'])->name('interactions.video.store');
        Route::post('/interactions/picture', [InteractionController::class, 'storePicture'])->name('interactions.picture.store');
        Route::post('/interactions/text', [InteractionController::class, 'storeText'])->name('interactions.text.store');
    });

    Route::post('/interactions/{interaction}/end', [InteractionController::class, 'endInteraction'])->name('interactions.end');

    Route::post('/interactions/{interaction}/winners/random', [WinnerController::class, 'generateRandomList'])->name('interactions.winners.random');
    Route::post('/interactions/{interaction}/winners/replace', [WinnerController::class, 'generate1Random'])->name('interactions.winners.replace');
    Route::post('/interactions/{interaction}/winners/fastest', [WinnerController::class, 'generateFastestList'])->name('interactions.winners.fastest');
    Route::post('/interactions/{interaction}/winners/confirm', [WinnerController::class, 'store'])->name('interactions.winners.confirm');
});

require __DIR__.'/auth.php';
