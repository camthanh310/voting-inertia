<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Status extends Model
{
    use HasFactory;

    const OPEN = 1;
    const CONSIDERING = 2;
    const IN_PROGRESS = 3;
    const IMPLEMENTED = 4;
    const CLOSED = 5;

    protected $fillable = [
        'name',
        'classes'
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public static function statuses(): array
    {
        return [
            'OPEN' => [
                'id' => self::OPEN,
                'text' => 'Open'
            ],
            'CONSIDERING' => [
                'id' => self::CONSIDERING,
                'text' => 'Considering'
            ],
            'IN_PROGRESS' => [
                'id' => self::IN_PROGRESS,
                'text' => 'In Progress'
            ],
            'IMPLEMENTED' => [
                'id' => self::IMPLEMENTED,
                'text' => 'Implemented'
            ],
            'CLOSED' => [
                'id' => self::CLOSED,
                'text' => 'Closed'
            ],
        ];
    }

    public static function getCount()
    {
        return Idea::query()
                ->selectRaw("count(*) as all_statuses")
                ->selectRaw("count(case when status_id = 1 then 1 end) as `OPEN`")
                ->selectRaw("count(case when status_id = 2 then 1 end) as `CONSIDERING`")
                ->selectRaw("count(case when status_id = 3 then 1 end) as `IN_PROGRESS`")
                ->selectRaw("count(case when status_id = 4 then 1 end) as `IMPLEMENTED`")
                ->selectRaw("count(case when status_id = 5 then 1 end) as `CLOSED`")
                ->toBase()
                ->first();
    }
}
