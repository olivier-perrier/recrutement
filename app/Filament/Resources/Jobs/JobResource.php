<?php

namespace App\Filament\Resources\Jobs;

use App\Filament\Resources\Jobs\Pages\CreateJob;
use App\Filament\Resources\Jobs\Pages\EditJob;
use App\Filament\Resources\Jobs\Pages\ListJobs;
use App\Filament\Resources\Jobs\RelationManagers\CandidaturesRelationManager;
use App\Models\Job;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $modelLabel = "Offres d'emploi";

    protected static ?string $model = Job::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static string|\UnitEnum|null $navigationGroup = 'Jobs';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')->label('Titre')->required(),
                    Select::make('contract_type')->label('Type de contrat')
                        ->options([
                            'cdi' => 'CDI',
                            'cdd' => 'CDD',
                            'interim' => 'Intérim',
                        ]),
                    Textarea::make('description')->label('Description')->required()->columnSpanFull(),
                    Select::make('company_id')->label('Entreprise')->required()
                        ->relationship('company', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Grid::make(2)->schema([
                                TextInput::make('name')->label("Nom de l'entreprise")->required(),
                                TextInput::make('size')->label("Taille de l'entreprise")->required()
                                    ->numeric(),
                            ]),
                        ])->createOptionModalHeading('Ajouter une nouvelle entreprise'),
                    TextInput::make('salary')->numeric()->label('Salaire')->suffix('€'),
                ])->columnSpan(2)
                    ->columns(2),
                Section::make('Adresse')->relationship('address')->schema([
                    TextInput::make('address')->label('Nom de entreprise'),
                    TextInput::make('street')->label('Rue'),
                    Grid::make(2)->schema([
                        TextInput::make('postcode')->label('Code postal')->required(),
                        TextInput::make('city')->label('Ville')->required()->default('Montpellier'),
                    ]),
                ])
                    ->columnSpan(1),
                FileUpload::make('images')->image()->multiple()
                    ->panelLayout('grid')
                    ->directory('jobs')
                    ->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Job::query()->orderBy('created_at', 'desc'))
            ->columns([
                Stack::make([
                    ImageColumn::make('image')->circular()
                        ->defaultImageUrl(url('/images/building.svg')),
                    TextColumn::make('title')->label('Nom')->sortable()->searchable(),
                    TextColumn::make('company.name')->label('Entreprise')->sortable()->searchable(),
                    TextColumn::make('contract_type')->label('Type de contrat')->sortable(),
                    TextColumn::make('address.city')->label('Ville')->searchable(),
                    TextColumn::make('salary')->label('Salaire')->sortable()
                        ->suffix(' €'),
                    // TextColumn::make('candidatures_count')->label('Postulations')
                    //     ->counts('candidatures')->sortable()
                    //     ->suffix(" candidature(s)")
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                SelectFilter::make('contract_type')->label('Type de contrat')
                    ->options([
                        'cdi' => 'CDI',
                        'cdd' => 'CDD',
                        'interim' => 'Intérim',
                    ]),
                SelectFilter::make('city')->label('Ville')
                    ->relationship('address', 'city')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('company')->label('Entreprise')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload(),

            ])
            ->recordActions([
                ViewAction::make('show')
                    ->slideOver()
                    ->modalHeading("Affichage de l'offre d'emploi"),
                // ->modalFooterActions([
                // Action::make("application")
                // ->action(function ($record) {
                // Candidature::create([
                //     "candidate_id" => auth()->user()->id,
                //     "job_id" => $record->id,
                // ]);
                // Notification::make()->title("Candidature envoyée")->success()->send();
                // })
                // ->label(fn ($record) => $record->candidatures()->where("candidate_id", auth()->user()->id)->exists() ? "Vous avez déjà postulé" : "Postuler")
                // ->disabled(fn ($record) => $record->candidatures()->where("candidate_id", auth()->user()->id)->exists()),
                // ]),
                EditAction::make('edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([15]);
    }

    public static function getRelations(): array
    {
        return [
            // CandidaturesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobs::route('/'),
            'create' => CreateJob::route('/create'),
            'edit' => EditJob::route('/{record}/edit'),
        ];
    }
}
