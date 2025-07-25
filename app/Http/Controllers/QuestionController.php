<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'direction' => 'nullable|string',
        'question' => 'required|string',
        'correctAnswer' => 'required|string',
        'explanation' => 'nullable|string',
        'wrongChoices' => 'required|array|min:1',
        'wrongChoices.*' => 'required|string',
    ]);

    $question = Question::create([
        'category_id' => $validated['category_id'],
        'direction' => $validated['direction'],
        'question_text' => $validated['question']
        ]);

    $question->choices()->create([
        'choice_text' => $validated['correctAnswer'],
        'is_correct' => true,
        'explanation' => $validated['explanation'],

    ]);

    foreach ($validated['wrongChoices'] as $choiceText) {
        $question->choices()->create([
            'choice_text' => $choiceText,
            'is_correct' => false,
        ]);
    }

    return redirect()->back()->with('success', 'Question added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'direction' => 'nullable|string',
            'question' => 'required|string',
            'correctAnswer' => 'required|string',
            'explanation' => 'nullable|string',
            'wrongChoices' => 'required|array|min:1',
            'wrongChoices.*' => 'required|string',
        ]);

        $question = Question::findOrFail($id);

        // Update the main question record
        $question->update([
            'category_id' => $validated['category_id'],
            'direction' => $validated['direction'],
            'question_text' => $validated['question'],
        ]);

        // Delete old choices
        $question->choices()->delete();

        // Create the correct choice
        $question->choices()->create([
            'choice_text' => $validated['correctAnswer'],
            'is_correct' => true,
            'explanation' => $validated['explanation'],
        ]);

        // Create the wrong choices
        foreach ($validated['wrongChoices'] as $choiceText) {
            $question->choices()->create([
                'choice_text' => $choiceText,
                'is_correct' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Question updated successfully!');
    }


    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        $question->choices()->delete();

        $question->delete();

        return redirect('/dashboard')->with('success', 'Question deleted successfully!');
    }
}

