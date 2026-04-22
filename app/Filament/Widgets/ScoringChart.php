<?php

namespace App\Filament\Widgets;

use App\Models\Scoring;
use App\Models\ScoringQuiz;
use Filament\Widgets\ChartWidget;

class ScoringChart extends ChartWidget
{
    protected ?string $heading = 'Note par type de certification';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $labels = ScoringQuiz::query()->select('name')->get()->map(fn ($s) => $s->name)->toArray();

        $scorings = Scoring::all()->groupBy('scoring_quiz_id');

        $returns = [];
        foreach ($scorings as $s) {
            $returns[$s->first()->scoringQuiz->name] = $s->avg('score');
        }

        $datasMax = [];
        foreach ($scorings as $s) {
            $datasMax[$s->first()->scoringQuiz->name] = $s->max('score');
        }

        // dd($returns);

        // dd(Scoring::select("scoring_quiz_id")->groupBy("scoring_quiz_id")->count("id"));

        return [
            'datasets' => [
                [
                    'label' => 'Note moyenne',
                    'data' => $returns,
                ],
                [
                    'label' => 'Note maximum',
                    'data' => $datasMax,
                    'borderColor' => '#9BD005',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
