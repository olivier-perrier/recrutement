<?php

namespace App\Filament\Resources\ScoringSections\RelationManagers;

use App\Models\ScoringQuestion;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ScoringQuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'scoringQuestions';

    protected static ?string $title = 'Questions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('question')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('points')->label('Nombre de point')
                    ->required()
                    ->numeric()->minValue(0),
                Select::make('type')
                    ->options([
                        ScoringQuestion::QUESTION_TOGGLE => 'Question à point',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
            ->columns([
                TextColumn::make('question')->limit(100)->sortable()->searchable(),
                TextColumn::make('points')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label('Créer une question')
                    ->mutateDataUsing(function ($data) {
                        $data['sort'] = 0;

                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort')
            ->reorderable('sort');
    }
}
