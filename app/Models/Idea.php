<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
