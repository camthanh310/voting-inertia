<?php

use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;

use function Pest\Laravel\assertDatabaseHas;

test('can check if idea is voted for by user', function () {
    $user = User::factory()->create();
    $userB = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    $idea = Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'title' => 'My First Idea',
        'description' => 'Description for my first idea'
    ]);

    Vote::factory()->create([
        'idea_id' => $idea->id,
        'user_id' => $user->id
    ]);

    expect($idea->isVotedByUser($user))->toBeTrue();
    expect($idea->isVotedByUser($userB))->toBeFalse();
    expect($idea->isVotedByUser(null))->toBeFalse();
});

test('user can vote for idea', function () {
    $user = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    $idea = Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'title' => 'My First Idea',
        'description' => 'Description for my first idea'
    ]);

    expect($idea->isVotedByUser($user))->toBeFalse();
    $idea->vote($user);
    expect($idea->isVotedByUser($user))->toBeTrue();
});

test('user can remove vote for idea', function () {
    $user = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    $idea = Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'title' => 'My First Idea',
        'description' => 'Description for my first idea'
    ]);

    Vote::factory()->create([
        'idea_id' => $idea->id,
        'user_id' => $user->id
    ]);

    expect($idea->isVotedByUser($user))->toBeTrue();
    $idea->removeVote($user);
    expect($idea->isVotedByUser($user))->toBeFalse();
});
