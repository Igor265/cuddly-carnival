<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => user()->questions,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|min:10|ends_with:?',
        ]);

        user()->questions()->create([
            'question' => $request->get('question'),
            'draft'    => true,
        ]);

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);
        $question->delete();

        return back();
    }
}
