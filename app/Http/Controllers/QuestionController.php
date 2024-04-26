<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'question' => 'required|string|min:10|ends_with:?',
        ]);
        Question::query()->create([
            'question' => $request->get('question'),
            'draft'    => true,
        ]);

        return redirect()->route('dashboard');
    }
}
