<?php

namespace App\Filament\Resources\ScoringQuizzes\Pages;

use App\Filament\Resources\ScoringQuizzes\ScoringQuizResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScoringQuizzes extends ListRecords
{
    protected static string $resource = ScoringQuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
