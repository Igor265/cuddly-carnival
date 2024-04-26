<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able tto list all questions created by me', function () {
    // Arrange
    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory(10)
        ->for($wrongUser, 'createdBy')
        ->create();

    $user      = User::factory()->create();
    $questions = Question::factory(10)
        ->for($user, 'createdBy')
        ->create();

    actingAs($user);
    // Act
    $response = get(route('question.index'));

    // Assert
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    /** @var Question $q */
    foreach ($wrongQuestions as $q) {
        $response->assertDontSee($q->question);
    }
});
