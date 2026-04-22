<?php

namespace App\Filament\Resources\Jobs\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CandidaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'candidates';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Placeholder::make('email')
                    ->content(fn (User $record): string => $record->email),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('candidate.name')
            ->columns([
                TextColumn::make('name')->label('Candidat'),
                TextColumn::make('created_at')->label('Date de candidature'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                // ->url(fn ($record) => UserResource::getUrl('view', [$record])),
                // Tables\Actions\EditAction::make(),
                DeleteAction::make()->label('Révoquer'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
