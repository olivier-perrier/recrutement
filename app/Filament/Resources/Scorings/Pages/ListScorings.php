<?php

namespace App\Filament\Resources\Scorings\Pages;

use App\Filament\Resources\Scorings\ScoringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScorings extends ListRecords
{
    protected static string $resource = ScoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
