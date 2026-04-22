<?php

namespace App\Filament\Resources\Scorings\Pages;

use App\Filament\Resources\Scorings\Form\ScoringForm;
use App\Filament\Resources\Scorings\ScoringResource;
use App\Models\ScoringAnswer;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class EditScoring extends EditRecord
{
    protected static string $resource = ScoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        $scoring_quiz = $schema->getRecord()->scoringQuiz;

        return $schema
            ->components([
                // Select::make('company_id')->label("Entreprise")
                //     ->relationship("company", "name")
                //     ->searchable()
                //     ->preload(),
                ScoringForm::getGeneratedWizard($scoring_quiz),
            ])->columns(1);
    }

    public function mutateFormDataBeforeFill(array $data): array
    {
        $wizard_attributes = $data;
        foreach ($this->record->scoringAnswers as $answer) {
            $wizard_attributes['answer'][$answer->scoringQuestion->id] = $answer->answer;
        }

        // $wizard_attributes = [];

        return $wizard_attributes;
    }

    public function handleRecordUpdate(Model $record, array $data): Model
    {
        // $record->update([
        //     "company_id" => $data["company_id"]
        // ]);

        foreach ($data['answer'] as $question_id => $answer_value) {
            // $res = ScoringAnswer::query()->find(['id' => $data_key], [
            //     'scoring_id' => $this->record->id,
            //     'answer' => $data_value,
            //     'scoring_question_id' => $data_key,
            // ])->update([
            //     'answer' => $data_value,
            // ]);

            $answer = ScoringAnswer::query()->where(['scoring_id' => $this->record->id, 'scoring_question_id' => $question_id])->first();
            // dd($answer);
            if ($answer) {
                $answer->update([
                    'answer' => $answer_value,
                ]);
            } elseif ($answer_value) {
                ScoringAnswer::create([
                    'scoring_id' => $this->record->id,
                    'answer' => $answer_value,
                    'scoring_question_id' => $question_id,
                ]);
            }
        }

        return $this->record;
    }

    public function getFormActions(): array
    {
        return [];
    }
}
