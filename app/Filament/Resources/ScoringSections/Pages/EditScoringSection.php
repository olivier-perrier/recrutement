<?php

namespace App\Filament\Resources\ScoringSections\Pages;

use App\Filament\Resources\ScoringSections\ScoringSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditScoringSection extends EditRecord
{
    protected static string $resource = ScoringSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
