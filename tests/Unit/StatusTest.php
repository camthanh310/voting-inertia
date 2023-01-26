<?php

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;

test('can get count of each status', function () {
    $user = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);
    $statusConsidering = Status::factory()->create(['name' => 'Considering']);
    $statusInProgress = Status::factory()->create(['name' => 'In Progress']);
    $statusImplemented = Status::factory()->create(['name' => 'Implemented']);
    $statusClosed = Status::factory()->create(['name' => 'Closed']);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusConsidering->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusConsidering->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusInProgress->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusInProgress->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusInProgress->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusImplemented->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusImplemented->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusImplemented->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusImplemented->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusClosed->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusClosed->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusClosed->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusClosed->id
    ]);

    Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusClosed->id
    ]);

    expect(15)->toEqual(Status::getCount()->all_statuses);
    expect(1)->toEqual(1, Status::getCount()->OPEN);
    expect(2)->toEqual(Status::getCount()->CONSIDERING);
    expect(3)->toEqual(Status::getCount()->IN_PROGRESS);
    expect(4)->toEqual(Status::getCount()->IMPLEMENTED);
    expect(5)->toEqual(Status::getCount()->CLOSED);
});
