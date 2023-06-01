<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AnswerTextController;
use App\Http\Controllers\CallToActionController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionChoiceController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\WinnerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// InteractionController Routes
Route::post('/interactions', [InteractionsController::class, 'store']);
Route::resource('interactions', InteractionController::class);

// AnswerController Routes
Route::resource('answers', AnswerController::class);

// AnswerTextController Routes
Route::resource('answerTexts', AnswerTextController::class);

// CallToActionController Routes
Route::resource('callToActions', CallToActionController::class);

// MediaController Routes
Route::resource('media', MediaController::class);

// QuestionChoiceController Routes
Route::resource('questionChoices', QuestionChoiceController::class);

// RewardController Routes
Route::resource('rewards', RewardController::class);

// WinnerController Routes
Route::resource('winners', WinnerController::class);

require __DIR__.'/auth.php';
