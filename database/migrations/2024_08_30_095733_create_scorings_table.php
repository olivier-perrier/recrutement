<?php

use App\Models\ScoringQuiz;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scorings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(ScoringQuiz::class)->constrained();
            $table->foreignIdFor(User::class, 'author_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scorings');
    }
};
