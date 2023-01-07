<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
