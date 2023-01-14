<?php

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

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

it('user who is not logged in is redirected to login page when trying to vote', function () {
    $user = User::factory()->create();

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

    post(
        route('vote.store', $idea)
    )->assertInertia(fn (AssertableInertia $assert) =>
        $assert->component('Auth/Login')
    );
});

it('user who is logged in can vote for idea', function () {
    $user = User::factory()->create();

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

    assertDatabaseMissing('votes', [
        'user_id' => $user->id,
        'idea_id' => $idea->id
    ]);

    actingAs($user)
        ->post(
        route('vote.store', $idea),
        ['has_voted' => false]
        );

    get(route('idea.index'))
        ->assertInertia(
            fn (AssertableInertia $assert) =>
                $assert->component('Idea/Index')
                    ->where('ideas.data.0.has_voted', true)
                    ->where('ideas.data.0.votes_count', 1)
        );

    assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'idea_id' => $idea->id
    ]);
});

it('user who is logged in can remove vote for idea', function () {
    $user = User::factory()->create();

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

    $idea->vote($user);

    assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'idea_id' => $idea->id
    ]);

    actingAs($user)
        ->post(
        route('vote.store', $idea),
        ['has_voted' => true]
        );

    get(route('idea.index'))
        ->assertInertia(
            fn (AssertableInertia $assert) =>
                $assert->component('Idea/Index')
                    ->where('ideas.data.0.has_voted', false)
                    ->where('ideas.data.0.votes_count', 0)
        );

    assertDatabaseMissing('votes', [
        'user_id' => $user->id,
        'idea_id' => $idea->id
    ]);
});