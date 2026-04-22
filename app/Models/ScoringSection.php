<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScoringSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'scoring_quiz_id',
        'sort',
        'icon',
    ];

    public function scoringQuestions(): HasMany
    {
        return $this->hasMany(ScoringQuestion::class);
    }

    public function scoringQuiz(): BelongsTo
    {
        return $this->belongsTo(ScoringQuiz::class);
    }

    public function getAnswers(Scoring $scoring): Collection
    {
        $questionIds = $this->scoringQuestions->pluck('id');

        return ScoringAnswer::query()
            ->whereIn('scoring_question_id', $questionIds)
            ->where('scoring_id', $scoring->id)
            ->get();
    }

    public function getScoreAttribute(Scoring $scoring): int
    {
        $points = 0;

        foreach ($this->scoringQuestions as $question) {
            $answer = $question->scoringAnswsers()->where('scoring_id', $scoring->id)->first();

            $points += $answer?->getPointAttribute($scoring);
        }

        return $points;
    }
}
