<?php

namespace App\Http\Controllers;

use App\Models\Scoring;
use App\Models\ScoringSection;
use Illuminate\Http\Request;

class ScoringSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Scoring $scoring)
    {
        return view('scoring-section.index', [
            'scoring' => $scoring->load(['scoringQuiz', 'scoringQuiz.scoringSections', 'scoringQuiz.scoringSections.scoringQuestions']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Scoring $scoring, ScoringSection $scoringSection)
    {
        $question = $scoringSection->scoringQuestions()->first();

        if ($question) {

            return redirect()->route('scorings.scoring-sections.scoring-questions.show', [$scoring, $scoringSection, $question]);
        } else {

            return view('scoring-section.show', [
                'scoring' => $scoring,
                'section' => $scoringSection,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScoringSection $scoringSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScoringSection $scoringSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScoringSection $scoringSection)
    {
        //
    }
}
