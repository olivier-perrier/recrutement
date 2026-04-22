<?php

use App\Models\Scoring;
use App\Models\ScoringQuestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoring_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ScoringQuestion::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Scoring::class)->constrained()->cascadeOnDelete();
            $table->string('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoring_answers');
    }
};
