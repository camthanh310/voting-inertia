<?php

namespace App\Http\Middleware;

use App\Models\Status;
use Inertia\Middleware;
use App\Models\Category;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CategoryResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success')
                ];
            },
            'categories' => CategoryResource::collection(Category::all()),
            'idea' => [
                'status_count' => Status::getCount()
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
