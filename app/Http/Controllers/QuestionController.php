<?php

namespace App\Http\Controllers;

use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|min:10|ends_with:?',
        ]);

        user()->questions()->create([
            'question' => $request->get('question'),
            'draft'    => true,
        ]);

        return redirect()->route('dashboard');
    }
}
