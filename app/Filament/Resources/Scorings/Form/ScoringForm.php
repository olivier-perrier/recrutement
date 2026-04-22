<?php

namespace App\Filament\Resources\Scorings\Form;

use App\Models\ScoringQuestion;
use App\Models\ScoringQuiz;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ScoringForm
{
    /**
     * Build the Wizard form based on the Scoring Sections and Questions
     */
    public static function getGeneratedWizard(ScoringQuiz $scoring_quiz): Wizard
    {
        // Select the quiz depending of the company category
        // $scoring_quiz = request()->user()->team->scoring_quiz;

        // Select all the Sections of the Quiz
        $steps = [];
        foreach ($scoring_quiz->scoringSections()->orderBy('sort')->get() as $section) {
            $setp_inputs = [];
            // Select every Question of the Section
            foreach ($section->scoringQuestions as $question) {
                if ($question->type == ScoringQuestion::QUESTION_TOGGLE) {
                    $setp_inputs[] = Toggle::make('answer.'.$question->id)->label($question->question);
                } elseif ($question->type == ScoringQuestion::QUESTION_INPUT) {
                    $setp_inputs[] = TextInput::make('answer.'.$question->id)->label($question->question);
                } elseif ($question->type == ScoringQuestion::QUESTION_COMPLEXE) {
                    $setp_inputs[] = TextInput::make('answer.'.$question->id)->label($question->question);
                }
            }
            $steps[] = Step::make($section->id)->label($section->title)->schema($setp_inputs);
        }

        $wizard = Wizard::make($steps)
            // ->startOnStep(5)
            // ->submitAction(('order-form.submit-button'));
            ->submitAction(new HtmlString(Blade::render('<x-filament::button type="submit" size="sm">Valider mon évaluation</x-filament::button>')));

        return $wizard;
    }
}
