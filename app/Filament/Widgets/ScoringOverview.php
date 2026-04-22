<?php

namespace App\Filament\Widgets;

use App\Models\Scoring;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ScoringOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make("Nombre total d'utilisateur", User::count()),
            Stat::make('Nombre de certification', Scoring::count()),
            Stat::make('Note moyenne', round(Scoring::all()->map(fn ($s) => $s->score)->avg()))
                ->chart(Scoring::all()->map(fn ($s) => $s->score)->toArray())
                ->color('success'),
        ];
    }

    // protected int | string | array $columnSpan = '2';

    // protected function getColumns(): int
    // {
    //     return 4;
    // }
}
