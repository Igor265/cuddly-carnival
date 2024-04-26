<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, post};

it('should be able to like a question', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    // Act
    post(route('question.like', $question->id))
        ->assertRedirect();

    // Assert
    \Pest\Laravel\assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);
});
