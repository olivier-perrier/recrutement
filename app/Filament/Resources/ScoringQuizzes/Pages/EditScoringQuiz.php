<?php

namespace App\Filament\Resources\ScoringQuizzes\Pages;

use App\Filament\Resources\ScoringQuizzes\ScoringQuizResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditScoringQuiz extends EditRecord
{
    protected static string $resource = ScoringQuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
