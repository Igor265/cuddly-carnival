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

it('should make sure that only questions with status DRAFT can be updated', function () {
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
    $responseNotDraft = put(route('question.update', $questionNotDraft->id));
    $responseDraft    = put(route('question.update', $draftQuestion->id), [
        'question' => 'New question?',
    ]);

    // Assert
    $responseNotDraft->assertForbidden();
    $responseDraft->assertRedirect();
});

it('should make sure that only the person who has created the question can update the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);
    put(route('question.update', $question->id))
        ->assertForbidden();

    actingAs($rightUser);
    put(route('question.update', $question->id), [
        'question' => 'New question?',
    ])->assertRedirect();
});
