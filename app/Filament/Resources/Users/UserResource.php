<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $modelLabel = 'Utilisateurs';

    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make()->schema([
                        TextInput::make('name')->label('Nom')->required(),
                        TextInput::make('email')->label('Email')->required()
                            ->unique('users', 'email')->visibleOn(['create', 'show'])
                            ->helperText('Le mot de passe par défault est "password"'),
                        TextEntry::make('email')->label('Email')->state(fn (User $record) => $record->email)->visibleOn('edit'),
                    ])->columns(2),
                    Section::make('Adresse')->schema([
                        TextInput::make('phone')->label('Téléphone'),
                        TextInput::make('address')->label('Adresse'),
                        TextInput::make('city')->label('Ville'),
                        TextInput::make('postcode')->label('Code postal'),
                    ])->columns(2),
                ])->columnSpan(2),
                Section::make('Autorisations')->schema([
                    Toggle::make('is_admin')->label('Administrateur')
                        ->disabled(fn (?User $user) => $user && request()->user()->id == $user->id)
                        ->helperText(fn (?User $user) => $user && request()->user()->id == $user->id ? 'Vous ne pouvez pas modifier cette option sur votre propre utilisateur' : ''),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nom')->sortable()->searchable(),
                TextColumn::make('email')->label('Email')->sortable()->toggleable(),
                IconColumn::make('is_admin')->label('Administrateur')->sortable()
                    ->boolean()
                    ->visible(request()->user()->isAdmin()),
            ])
            ->filters([
                Filter::make('is_admin')->label('Administrateurs')->toggle()
                    ->query(fn ($query) => $query->where('is_admin', true)),
            ])
            ->recordActions([
                EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
