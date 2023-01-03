<?php

use App\Models\Idea;

use function Pest\Laravel\get;

it('list of ideas shows on main page', function () {
    $ideaOne = Idea::factory()->create([
        'title' => 'My First Idea',
        'description' => 'My First Description idea'
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Second Idea',
        'description' => 'My Second Description idea'
    ]);

    get(route('idea.index'))
        ->assertSuccessful()
        ->assertSee($ideaOne->title)
        ->assertSee($ideaOne->description)
        ->assertSee($ideaTwo->title)
        ->assertSee($ideaTwo->description);
});

it('single idea shows correctly on the show page', function () {
    $idea = Idea::factory()->create([
        'title' => 'My First idea',
        'description' => 'My First idea description'
    ]);

    get(route('idea.show', $idea))
        ->assertSuccessful()
        ->assertSee($idea->title)
        ->assertSee($idea->description);
});

it('ideas pagination works', function () {
    Idea::factory(Idea::PAGINATION_COUNT + 1)->create();

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
    $ideaOne = Idea::factory()->create([
        'title' => 'My Idea',
        'description' => 'My First Idea Description',
    ]);

    $ideaTwo = Idea::factory()->create([
        'title' => 'My Idea',
        'description' => 'Another Idea Description',
    ]);

    get(route('idea.show', $ideaOne))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea');

    get(route('idea.show', $ideaTwo))
        ->assertSuccessful();

    expect(request()->path())->toEqual('ideas/my-idea-2');
});


