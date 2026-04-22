<?php

namespace App\Filament\Resources\ScoringSections\Pages;

use App\Filament\Resources\ScoringSections\ScoringSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScoringSections extends ListRecords
{
    protected static string $resource = ScoringSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
