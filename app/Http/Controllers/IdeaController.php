<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Inertia\Inertia;
use App\Http\Resources\IdeaResource;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->merge([
            'vote_by_user' => true
        ]);

        $filters = ['filter' => $request->get('filter')];

        $ideas = IdeaResource::collection(
            Idea::filter($filters)
                ->with([
                    'user',
                    'category',
                    'status'
                ])
                ->withVotedByUser()
                ->withCount(['votes'])
                ->orderByDesc('id')
                ->simplePaginate(Idea::PAGINATION_COUNT)
                ->withQueryString()
            );

        return Inertia::render('Idea/Index', [
            'ideas' => $ideas,
            'filter' => [
                'status_id' => data_get($filters, 'filter.status_id', '')
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdeaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdeaRequest $request)
    {
        Idea::create($request->validate());

        return to_route('idea.index')->with('success', 'Idea was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        return Inertia::render('Idea/Show', [
            'idea' => IdeaResource::make(
                $idea
                    ->load([
                        'user',
                        'category',
                        'status'
                    ])
                    ->loadCount(['votes'])
            )
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdeaRequest  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
