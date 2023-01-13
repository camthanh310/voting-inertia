<?php

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('index page correctly receives vote count', function () {
    $user = User::factory()->create();
    $userB = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create([
        'name' => 'Open',
        'classes' => 'bg-gray-200'
    ]);

    $idea = Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'title' => 'My First Idea',
        'description' => 'Description for my first idea'
    ]);

    Vote::factory()->create([
        'idea_id' => $idea->id,
        'user_id' => $user->id,
    ]);

    Vote::factory()->create([
        'user_id' => $userB->id,
        'idea_id' => $idea->id,
    ]);

    get(
        route('idea.index')
    )->assertInertia(
        fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->where('ideas.data.0.votes_count', 2)
    );
});

it('user who is logged in shows voted if idea already voted for', function () {
    $user = User::factory()->create();
    $userB = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $statusOpen = Status::factory()->create([
        'name' => 'Open',
        'classes' => 'bg-gray-200'
    ]);

    $idea = Idea::factory()->create([
        'user_id' => $user->id,
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'title' => 'My First Idea',
        'description' => 'Description for my first idea'
    ]);

    Vote::factory()->create([
        'idea_id' => $idea->id,
        'user_id' => $user->id,
    ]);

    Vote::factory()->create([
        'idea_id' => $idea->id,
        'user_id' => $userB->id,
    ]);

    actingAs($user)
        ->get(
            route('idea.index')
        )->assertInertia(
            fn (AssertableInertia $assert) => $assert
                ->component('Idea/Index')
                ->where('ideas.data.0.votes_count', 2)
                ->where('ideas.data.0.has_voted', true)
        );
});