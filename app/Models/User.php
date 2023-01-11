<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public function getAvatar(): string
    {
        $firsCharacter = $this->email[0];

        $ordNumber = is_numeric($firsCharacter) ? 21 : 96;

        $integerToUser = ord(Str::lower($firsCharacter)) - $ordNumber;

        $defaultUrl = 'https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-' . $integerToUser . '.png';

        return 'https://www.gravatar.com/avatar/'
            . md5($this->email)
            . urldecode(
                http_build_query([
                    '?s' => 200,
                    'd' => $defaultUrl
                ]
            )
        );
    }

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(
            Idea::class, 'votes'
        );
    }
}
