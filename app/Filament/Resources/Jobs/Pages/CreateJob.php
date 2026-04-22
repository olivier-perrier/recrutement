<?php

namespace App\Filament\Resources\Jobs\Pages;

use App\Filament\Resources\Jobs\JobResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJob extends CreateRecord
{
    protected static string $resource = JobResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['team_id'] = auth()->user()->team->id;

        return $data;
    }
}
