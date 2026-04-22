<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'contract_type',
        'images',
        'address_id',
        'company_id',
        'team_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // public function candidatures(): HasMany
    // {
    //     return $this->HasMany(Candidature::class);
    // }

    public function candidates(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'candidatures');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeWithoutCandidature(Builder $query): void
    {
        if (auth()->user()) {
            $query->whereDoesntHave('candidatures', function (Builder $query) {
                $query->where('user_id', '=', auth()->user()->id);
            });
        }
    }

    public function hasCandidatureAttribute(): bool
    {
        dd($this->candidatures);

        return $this->candidatures()->where('user_id', auth()->user());
    }

    protected function hasCandidature(): Attribute
    {
        return Attribute::make(
            get: fn ($value): bool => $this->candidatures()->where('user_id', auth()->user()->id)->exists(),
        );
    }
}
