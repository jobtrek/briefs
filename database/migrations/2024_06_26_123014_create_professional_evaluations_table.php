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
        Schema::create('professional_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('teamwork')->nullable();
            $table->text('teamwork_comment')->nullable();
            $table->integer('punctuality')->nullable();
            $table->text('punctuality_comment')->nullable();
            $table->integer('reactivity')->nullable();
            $table->text('reactivity_comment')->nullable();
            $table->integer('communication')->nullable();
            $table->text('communication_comment')->nullable();
            $table->integer('problem_solving')->nullable();
            $table->text('problem_solving_comment')->nullable();
            $table->integer('adaptability')->nullable();
            $table->text('adaptability_comment')->nullable();
            $table->integer('innovation')->nullable();
            $table->text('innovation_comment')->nullable();
            $table->integer('professionalism')->nullable();
            $table->text('professionalism_comment')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_evaluations');
    }
};
