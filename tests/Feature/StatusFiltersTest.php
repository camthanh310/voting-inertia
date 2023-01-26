<?php

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('filtering works when query string in place', function () {
    $user = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);
    $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);
    $statusInprogress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-yellow text-white']);
    $statusImplemented = Status::factory()->create(['name' => 'Implemented', 'classes' => 'bg-green text-white']);
    $statusClosed = Status::factory()->create(['name' => 'Closed', 'classes' => 'bg-red text-white']);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id
        ]);

    get(
        route('idea.index'),
        [
            'filter' => [
                'status_id' => Status::IMPLEMENTED
            ]
        ]
    )
    ->assertInertia(
        fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->where('ideas.data.0.status.id', Status::IMPLEMENTED)
    );
});
