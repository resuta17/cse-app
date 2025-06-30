<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Category;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::get('/about', function () {
    $questions = Question::all(); // You can add pagination or filtering here

    return Inertia::render('About', [
        'questions' => $questions
    ]);
})->name('about');

Route::get('/Practice', function () {
    $categories = Category::all(); // You can add pagination or filtering here

    return Inertia::render('Exam', [
        'categories' => $categories
    ]);
})->name('exam');


Route::get('/Examination', function () {
    $name = request('name');
    $id = request('id');

    $questions = Question::with('choices')
    ->where('category_id', $id)
    ->inRandomOrder()
    ->limit(20)
    ->get()
    ->each(function ($question) {
        $question->setRelation('choices', $question->choices->shuffle());
    });


     return Inertia::render('Examination', compact('id','name', 'questions'));
})->name('practice');
//Route::get('/Practice', fn() => Inertia::render('Exam'))->name('exam');


require __DIR__.'/auth.php';
