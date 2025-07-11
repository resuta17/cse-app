<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Category;
use App\Http\Controllers\QuestionController;
 

Route::get('/login', function () {
    return Inertia::render('Login');
});


Route::get('/dashboard', function () {
    $categoriesWithCount = Category::withCount('questions')->get();
    $questions = Question::paginate(20);

    return Inertia::render('Dashboard', ['categoriesWithCount' => $categoriesWithCount, 'questions' =>  $questions]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/edit', function () {
    $id = request('id');
    $categories = Category::all();
    $question = Question::with(['category', 'choices'])->findOrFail($id);
    return Inertia::render('Admin', [
        'question' => $question,
        'categories' => $categories
    ]);
})->middleware(['auth', 'verified'])->name('question');


Route::get('/admin', function () {
    $categories = Category::all();
        
    $emptyQuestion = [
        'id' => null,
        'category_id' => '',
        'direction' => '',
        'question_text' => '',
        'choices' => [],
    ];

    return Inertia::render('Admin', [
        'categories' => $categories,
        'question' => $emptyQuestion
    ]);
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::get('/about', function () {
    $questions = Question::all(); 
    return Inertia::render('About', [
        'questions' => $questions
    ]);
})->name('about');

Route::get('/Practice', function () {
    $categories = Category::all(); 

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
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');



require __DIR__.'/auth.php';
