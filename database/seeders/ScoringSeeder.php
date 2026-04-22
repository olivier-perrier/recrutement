<?php

namespace Database\Seeders;

use App\Models\Scoring;
use App\Models\ScoringQuiz;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void
    {
        $scoringQuizes = ScoringQuiz::all();

        foreach ($scoringQuizes as $quiz) {

            Scoring::factory()->create([
                'scoring_quiz_id' => $quiz->id,
                'author_id' => $user->id,
            ]);
        }
    }
}
