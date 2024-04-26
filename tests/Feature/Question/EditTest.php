<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to open a question to edit', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();
    actingAs($user);

    // Act
    $response = get(route('question.edit', $question->id));

    // Assert
    $response->assertSuccessful();
});
