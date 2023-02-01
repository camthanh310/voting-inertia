<?php

use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use Inertia\Testing\AssertableInertia;

it('other filtering works with top voted', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);

    $idea1 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea'
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea'
        ]);

    $idea1->vote($user1);
    $idea1->vote($user2);

    get(
        route('idea.index', [
            'sort' => 'top_voted'
        ]),
    )
    ->assertInertia(
        fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->has('ideas.data', 2)
            ->where('ideas.data.0.title', 'My First Idea')
            ->where('ideas.data.1.title', 'My Second Idea')
    );
});

it('users not login other filtering works with my ideas will empty', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);

    $idea1 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea'
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea'
        ]);

    get(
        route('idea.index', [
            'filter' => [
                'my_ideas' => 'my_ideas'
            ]
        ]),
    )
    ->assertInertia(
        fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->has('ideas.data', 0)
    );
});

it('login users other filtering works with my ideas', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);

    $idea1 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea'
        ]);

    Idea::factory()
        ->create([
            'user_id' => $user2->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea'
        ]);

    actingAs($user1)
        ->get(
            route('idea.index', [
                'filter' => [
                    'my_ideas' => 'my_ideas'
                ]
            ]),
        )
        ->assertInertia(
            fn (AssertableInertia $assert) => $assert
                ->component('Idea/Index')
                ->has('ideas.data', 1)
                ->where('ideas.data.0.title', 'My First Idea')
        );
});

it('status filter category filter other filtering works together', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open']);
    $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

    $idea1 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My First Idea'
        ]);

    $idea2 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea'
        ]);

    $idea3 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryTwo->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My Third Idea'
        ]);

    $idea4 = Idea::factory()
        ->create([
            'user_id' => $user1->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => 'My Fourth Idea'
        ]);

    $idea1->vote($user1);
    $idea1->vote($user2);

    get(
        route('idea.index', [
            'filter' => [
                'status_id' => Status::CONSIDERING,
                'category_id' => $categoryOne->id
            ],
            'sort' => 'top_voted'
        ]),
    )
    ->assertInertia(
        fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->has('ideas.data', 2)
            ->where('ideas.data.0.title', 'My First Idea')
            ->where('ideas.data.1.title', 'My Fourth Idea')
    );

});