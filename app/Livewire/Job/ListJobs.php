<?php

namespace App\Livewire\Job;

use App\Models\Address;
use App\Models\Job;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListJobs extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Job $job;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Rechercher un post')
                    ->live(),
                Select::make('company_id')->label('Entreprise')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload()
                    ->live(),
                Select::make('city')->label('Ville')
                    // ->relationship("address", "city")
                    ->options(Address::pluck('city', 'city'))
                    ->searchable()
                    ->preload()
                    ->live(),
                ToggleButtons::make('contract_type')->label('Type de contrat')
                    ->options([
                        'CDI' => 'CDI',
                        'CDD' => 'CDD',
                        'Interim' => 'Interim',
                    ])
                    ->multiple()
                    ->inline()
                    ->live(),
            ])
            ->columns(4)
            ->statePath('data')
            ->model(Job::class);
    }

    public function render()
    {
        $query = Job::query()
            ->when($this->data['title'], fn ($query, $title) => $query->where('title', 'like', '%'.$title.'%'))
            ->when($this->data['contract_type'], fn ($query, $contract_type) => $query->whereIn('contract_type', $contract_type))
            ->when($this->data['company_id'], fn ($query, $company_id) => $query->where('company_id', $company_id))
            ->when($this->data['city'], fn ($query, $city) => $query->whereHas('address', function (Builder $query) use ($city) {
                $query->where('city', $city);
            }));

        $job_count = $query->count();

        $jobs = $query
            ->limit(10)
            ->get();

        return view('livewire.job.list-jobs', [
            'jobs' => $jobs,
            'job_count' => $job_count,
        ]);
    }
}
