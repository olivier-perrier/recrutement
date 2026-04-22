<?php

namespace App\Filament\Widgets;

use App\Models\Scoring;
use App\Models\ScoringSection;
use Filament\Widgets\ChartWidget;

class ScoringChartCategory extends ChartWidget
{
    protected ?string $heading = "Certifications par catégorie d'entreprise";

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $labels = ScoringSection::query()->pluck('title')->toArray();

        $scorings = Scoring::all()->groupBy(function ($item, int $key) {
            if (@$item->author->company->category_id) {
                return $item->author->company->category->name;
            }
        });

        // dd($scorings);

        $returns = [];
        foreach ($scorings as $key => $collection) {
            $returns[$key] = $collection->avg('score');
        }

        $datasMax = [];
        foreach ($scorings as $key => $collection) {
            $datasMax[$key] = $collection->max('score');
        }

        // dd($returns);

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
