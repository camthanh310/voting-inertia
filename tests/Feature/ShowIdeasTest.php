<?php

use App\Models\Idea;
use App\Models\Status;

use App\Models\Category;
use function Pest\Laravel\get;
use Inertia\Testing\AssertableInertia;

it('list of ideas shows on main page', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
    $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

    $ideaOne = Idea::factory()->create([
        'title' => 'My First Idea',
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'description' => 'My First Description idea'
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Second Idea',
        'category_id' => $categoryTwo->id,
        'status_id' => $statusConsidering->id,
        'description' => 'My Second Description idea'
    ]);

    get(route('idea.index'))
        ->assertInertia(fn (AssertableInertia $assert) => $assert
            ->component('Idea/Index')
            ->has('ideas.data', 2)
            ->where('ideas.data.0.title', $ideaTwo->title)
            ->where('ideas.data.0.description', $ideaTwo->description)
            ->where('ideas.data.0.category.name', $categoryTwo->name)
            ->where('ideas.data.0.status.name', $statusConsidering->name)
            ->where('ideas.data.1.title', $ideaOne->title)
            ->where('ideas.data.1.description', $ideaOne->description)
            ->where('ideas.data.1.category.name', $categoryOne->name)
            ->where('ideas.data.1.status.name', $statusOpen->name)
    );
});

it('single idea shows correctly on the show page', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    $idea = Idea::factory()->create([
        'title' => 'My First idea',
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'description' => 'My First idea description'
    ]);

    get(route('idea.show', $idea))
        ->assertInertia(fn (AssertableInertia $assert) => $assert
            ->component('Idea/Show')
            ->where('idea.title', $idea->title)
            ->where('idea.description', $idea->description)
            ->where('idea.category.name', $categoryOne->name)
            ->where('idea.status.name', $statusOpen->name)
        );
});

it('ideas pagination works', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

    Idea::factory(Idea::PAGINATION_COUNT + 1)->create(['category_id' => $categoryOne->id, 'status_id' => $statusOpen->id]);

    $ideaOne = Idea::find(1);
    $ideaOne->title = 'My First Idea';
    $ideaOne->save();

    $ideaEleven = Idea::find(11);
    $ideaEleven->title = 'My Eleventh Idea';
    $ideaEleven->save();

    get('/')
        ->assertSee($ideaEleven->title)
        ->assertDontSee($ideaOne->title);

    get('/?page=2')
        ->assertSee($ideaOne->title)
        ->assertDontSee($ideaEleven->title);
});

it('same idea title different slugs', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
    $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

    $ideaOne = Idea::factory()->create([
        'title' => 'My Idea',
        'category_id' => $categoryOne->id,
        'status_id' => $statusOpen->id,
        'description' => 'My First Idea Description',
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Idea',
        'category_id' => $categoryTwo->id,
        'status_id' => $statusConsidering->id,
        'description' => 'Another Idea Description',
    ]);

    get(route('idea.show', $ideaOne))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea');

    get(route('idea.show', $ideaTwo))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea-2');
});


