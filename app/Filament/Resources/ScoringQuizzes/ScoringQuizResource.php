<?php

namespace App\Filament\Resources\ScoringQuizzes;

use App\Filament\Resources\ScoringQuizzes\Pages\CreateScoringQuiz;
use App\Filament\Resources\ScoringQuizzes\Pages\EditScoringQuiz;
use App\Filament\Resources\ScoringQuizzes\Pages\ListScoringQuizzes;
use App\Filament\Resources\ScoringQuizzes\RelationManagers\ScoringSectionsRelationManager;
use App\Models\ScoringQuiz;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ScoringQuizResource extends Resource
{
    protected static ?string $modelLabel = 'Questionnaires';

    protected static ?string $model = ScoringQuiz::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Scorings';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nom')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ScoringSectionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListScoringQuizzes::route('/'),
            'create' => CreateScoringQuiz::route('/create'),
            'edit' => EditScoringQuiz::route('/{record}/edit'),
        ];
    }
}
