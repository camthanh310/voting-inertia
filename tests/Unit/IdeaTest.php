<?php

use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;

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
