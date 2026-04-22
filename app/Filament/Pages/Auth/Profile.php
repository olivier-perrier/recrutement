<?php

namespace App\Filament\Pages\Auth;

use App\Models\Category;
use App\Models\Company;
use Filament\Auth\Pages\EditProfile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class Profile extends EditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    Select::make('company_id')->label('Entreprise')
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
                ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Profil candidat')
                            ->inlineLabel(false)
                            ->schema([
                                Grid::make(3)->schema([
                                    Group::make([
                                        TextInput::make('job_title')->label('Titre de votre post actuel'),
                                        Textarea::make('description')->label('Description de votre profil')
                                            ->maxLength(255),
                                    ])
                                        ->columnSpan(2),
                                    Group::make([
                                        TextInput::make('age')->label('Age')
                                            ->numeric()->minValue(18)->maxValue(100),
                                        Select::make('domaine')->label("Domaines d'activité")
                                            ->multiple()
                                            ->preload()
                                            ->options(Category::ofCompany()->pluck('name', 'id')),
                                    ])
                                        ->columnSpan(1),
                                ]),
                                Repeater::make('experiences')->schema([
                                    TextInput::make('name')->hiddenLabel()
                                        ->required()
                                        ->placeholder("Nom de l'experience"),
                                    Grid::make(2)->schema([
                                        DatePicker::make('start_date')->label('Date de début')
                                            ->required(),
                                        DatePicker::make('end_date')->label('Date de fin'),
                                    ]),
                                    Select::make('company')->hiddenLabel()
                                        ->required()
                                        ->placeholder('Selectionnez une entreprise')
                                        ->options(Company::all()->pluck('name', 'id')),
                                    Textarea::make('description')->label('Description'),
                                ])
                                    ->addActionLabel('Ajouter une experience'),
                            ]),
                    ]),
            ]);
    }
}
