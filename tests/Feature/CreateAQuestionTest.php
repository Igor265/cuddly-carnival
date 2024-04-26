<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);
});

it('should check if ends with question mark ?', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.ends_with', ['attribute' => 'question', 'values' => '?'])]);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    assertDatabaseCount('questions', 0);
});

it('shoul create as a draft all the time', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});
