<?php

use App\Models\Category;
use App\Models\Idea;

use function Pest\Laravel\get;

it('list of ideas shows on main page', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $ideaOne = Idea::factory()->create([
        'title' => 'My First Idea',
        'category_id' => $categoryOne->id,
        'description' => 'My First Description idea'
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Second Idea',
        'category_id' => $categoryTwo->id,
        'description' => 'My Second Description idea'
    ]);

    get(route('idea.index'))
        ->assertSuccessful()
        ->assertSee($ideaOne->title)
        ->assertSee($ideaOne->description)
        ->assertSee($categoryOne->name)
        ->assertSee($ideaTwo->title)
        ->assertSee($ideaTwo->description)
        ->assertSee($categoryTwo->name);
});

it('single idea shows correctly on the show page', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    $idea = Idea::factory()->create([
        'title' => 'My First idea',
        'category_id' => $categoryOne->id,
        'description' => 'My First idea description'
    ]);

    get(route('idea.show', $idea))
        ->assertSuccessful()
        ->assertSee($idea->title)
        ->assertSee($idea->description)
        ->assertSee($categoryOne->name);
});

it('ideas pagination works', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);

    Idea::factory(Idea::PAGINATION_COUNT + 1)->create(['category_id' => $categoryOne->id]);

    $ideaOne = Idea::find(1);
    $ideaOne->title = 'My First Idea';
    $ideaOne->save();

    $ideaEleven = Idea::find(11);
    $ideaEleven->title = 'My Eleventh Idea';
    $ideaEleven->save();

    get('/')
        ->assertSee($ideaOne->title)
        ->assertDontSee($ideaEleven->title);

    get('/?page=2')
        ->assertSee($ideaEleven->title)
        ->assertDontSee($ideaOne->title);
});

it('same idea title different slugs', function () {
    $categoryOne = Category::factory()->create(['name' => 'Category 1']);
    $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

    $ideaOne = Idea::factory()->create([
        'title' => 'My Idea',
        'category_id' => $categoryOne->id,
        'description' => 'My First Idea Description',
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Idea',
        'category_id' => $categoryTwo->id,
        'description' => 'Another Idea Description',
    ]);

    get(route('idea.show', $ideaOne))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea');

    get(route('idea.show', $ideaTwo))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea-2');
});


