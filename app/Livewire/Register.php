<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')->label('Nom')
                        ->required(),
                    TextInput::make('email')->email()->unique(User::class),
                    TextInput::make('password')->label('Mot de passe')->password()
                        ->confirmed()
                        ->rule(Password::default()),
                    TextInput::make('password_confirmation')->label('Confirmation du mot de passe')->password(),
                ]),
                Section::make("Informations sur l'entreprise")
                    ->relationship('company')
                    ->schema([
                        TextInput::make('name')->label("Nom de l'entreprise")
                            ->required(),
                        TextInput::make('address.street')->label('Adresse')
                            ->required(),
                        TextInput::make('address.city')->label('Ville')
                            ->required(),
                    ]),
            ])
            ->statePath('data')
            ->model(User::class);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $record = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->form->model($record)->saveRelationships();
    }

    public function render()
    {
        return view('livewire.register');
    }
}
