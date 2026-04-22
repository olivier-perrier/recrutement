<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScoringQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'points',
        'type',
        'sort',
    ];

    public const QUESTION_INPUT = 'QUESTION_INPUT';

    public const QUESTION_TOGGLE = 'QUESTION_TOGGLE';

    public const QUESTION_COMPLEXE = 'QUESTION_COMPLEXE';

    public function scoringSection(): BelongsTo
    {
        return $this->belongsTo(ScoringSection::class);
    }

    public function scoringAnswsers(): HasMany
    {
        return $this->HasMany(ScoringAnswer::class);
    }

    public function getAnswer(Scoring $scoring): ?ScoringAnswer
    {
        return $this->scoringAnswsers()->where('scoring_id', $scoring->id)->first();
    }
}
