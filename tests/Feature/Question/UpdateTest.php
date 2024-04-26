<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should update the question', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);
    actingAs($user);

    // Act
    put(route('question.update', $question->id), [
        'question' => 'Updated question?',
    ])->assertRedirect();

    $question->refresh();

    // Assert
    expect($question)->question->toBe('Updated question?');
});
