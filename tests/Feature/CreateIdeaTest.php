<?php


use App\Models\User;
use App\Models\Category;
use App\Models\Status;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

use Inertia\Testing\AssertableInertia;

it('create idea form validation works', function () {
    actingAs(User::factory()->create())
        ->postJson(route('idea.store'), [
            'title' => '',
            'category_id' => '',
            'description' => ''
        ])
        ->assertJson([
            'errors' => [
                'category_id' => ['The category id field is required.'],
                'title' => ['The title field is required.'],
                'description' => ['The description field is required.'],
            ]
        ]);
});

it('creating an idea works correctly', function () {
    $user = User::factory()->create();
    $categoryOne = Category::factory()->create();

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    actingAs($user)
        ->postJson(route('idea.store'), [
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'description' => 'Hello World'
        ])
        ->assertRedirect('/');

    actingAs($user)
            ->get(route('idea.index'))
            ->assertInertia(fn (AssertableInertia $assert) => $assert
                ->component('Idea/Index')
                ->has('ideas.data', 1)
                ->where('ideas.data.0.title', 'My First Idea')
                ->where('ideas.data.0.description', 'Hello World')
                ->where('ideas.data.0.category.name', $categoryOne->name)
                ->where('ideas.data.0.status.name', $statusOpen->name)
        );

    assertDatabaseHas('ideas', [
        'title' => 'My First Idea',
    ]);
});

it('creating two ideas with same title still works but has different slugs', function () {
    $user = User::factory()->create();
    $categoryOne = Category::factory()->create();

    Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    actingAs($user)
        ->postJson(route('idea.store'), [
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'description' => 'Hello World'
        ])
        ->assertRedirect('/');

    assertDatabaseHas('ideas', [
        'title' => 'My First Idea',
        'slug' => 'my-first-idea'
    ]);

    actingAs($user)
        ->postJson(route('idea.store'), [
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'description' => 'Hello World'
        ])
        ->assertRedirect('/');

    assertDatabaseHas('ideas', [
        'title' => 'My First Idea',
        'slug' => 'my-first-idea-2'
    ]);
});

