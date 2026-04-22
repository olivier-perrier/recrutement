<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoringAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'scoring_id',
        'scoring_question_id',
        'answer',
    ];

    public function scoringQuestion(): BelongsTo
    {
        return $this->belongsTo(ScoringQuestion::class);
    }

    public function getPointAttribute(Scoring $scoring): int
    {
        $points = 0;

        if ($this->scoringQuestion->type == ScoringQuestion::QUESTION_COMPLEXE) {
            switch ($this->scoringQuestion->operator) {
                case '>':
                    if ($this->answer > $this->scoringQuestion->reference) {
                        $points = $this->scoringQuestion->points;
                    }
                    break;

                case '<':
                    if ($this->answer < $this->scoringQuestion->reference) {
                        $points = $this->scoringQuestion->points;
                    }
                    break;

                case '==':
                    if ($this->answer == $this->scoringQuestion->reference) {
                        $points = $this->scoringQuestion->points;
                    }
                    break;

                case '!=':
                    if ($this->answer != $this->scoringQuestion->reference) {
                        $points = $this->scoringQuestion->points;
                    }
                    break;

                default:
                    break;
            }
        } elseif ($this->scoringQuestion->type == ScoringQuestion::QUESTION_TOGGLE) {
            if ($this->scoringQuestion->scoringAnswsers()->where('scoring_id', $scoring->id)->where('answer', true)->exists()) {
                $points = $this->scoringQuestion->points;
            }
        }

        return $points;
    }
}
