<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to open a question to edit', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);
    actingAs($user);

    // Act
    $response = get(route('question.edit', $question->id));

    // Assert
    $response->assertSuccessful();
});

it('should return a view', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);
    actingAs($user);

    // Act
    $response = get(route('question.edit', $question->id));

    // Assert
    $response->assertViewIs('question.edit');
});

it('should make sure that only questions with status DRAFT can be edited', function () {
    // Arrange
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => false]);
    $draftQuestion = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);
    actingAs($user);

    // Act
    $responseNotDraft = get(route('question.edit', $questionNotDraft->id));
    $responseDraft    = get(route('question.edit', $draftQuestion->id));

    // Assert
    $responseNotDraft->assertForbidden();
    $responseDraft->assertSuccessful();
});
