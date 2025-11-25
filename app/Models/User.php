<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Scope untuk pencarian dan filter
     */
   public function scopeSearchAndFilter(
        Builder $query,
        ?string $search = null,
        array $filters = []
    ): Builder
    {
        // search name/email
        $query->when($search, function (Builder $q) use ($search) {
            $q->where(function (Builder $qq) use ($search) {
                $qq->where('name', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%");
            });
        });

        return $query;
    }

    /**
     * SORT builder (case-insensitive untuk text)
     */
    public function scopeSort($query, $sortBy = null, $sortOrder = null)
{
    if ($sortBy && $sortOrder) {
        if (in_array($sortBy, ['name', 'email'])) {
            return $query->orderByRaw("LOWER($sortBy) $sortOrder");
        }
        return $query->orderBy($sortBy, $sortOrder);
    }

    return $query->orderBy('created_at', 'desc');
}

}
