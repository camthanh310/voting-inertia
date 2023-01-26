<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Idea extends Model
{
    use HasFactory;
    use Sluggable;

    const PAGINATION_COUNT = 10;

    protected $fillable = [
        'user_id',
        'category_id',
        'status_id',
        'title',
        'slug',
        'description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'votes'
        );
    }

    public function isVotedByUser(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $user->votes()
                    ->where('idea_id', $this->id)
                    ->exists();
    }

    public function scopeWithVotedByUser(Builder $builder): Builder
    {
        return $builder->addSelect([
            'vote_by_user' => Vote::query()
                ->select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('idea_id', 'ideas.id')
                ->limit(1)
        ]);
    }

    public function vote(User $user): void
    {
        $this->votes()->attach($user->id);
    }

    public function removeVote(User $user): void
    {
        $this->votes()->detach($user->id);
    }

    public static function filter(array $data): QueryBuilder
    {
        $request = new Request($data);

        $filters = collect([
            AllowedFilter::callback(
                'status_id',
                function (Builder $builder, $value) {
                    $builder->when(
                        !blank($value),
                        fn (Builder $builder) => $builder->where('status_id', $value)
                    );
                }
            ),
            AllowedFilter::callback(
                'category_id',
                function (Builder $builder, $value) {
                    $builder->when(
                        !blank($value),
                        fn (Builder $builder) => $builder->where('category_id', $value)
                    );
                }
            )
        ]);

        return QueryBuilder::for(self::class, $request)
                    ->allowedFilters($filters->toArray());
    }
}
