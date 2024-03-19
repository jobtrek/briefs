<?php

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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->date('date_evaluation');
            $table->text('commentaire_general_mandat');
            $table->foreignId('brief_id')->constrained();
            $table->foreignId('criteria_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('evaluation_criteria_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
