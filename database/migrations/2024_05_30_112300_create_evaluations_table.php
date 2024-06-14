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
<<<<<<<< HEAD:database/migrations/2024_05_30_112300_create_evaluations_table.php
            $table->foreignId('brief_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
========
            $table->foreignId('brief_id')->constrained();
            $table->foreignId('criteria_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('evaluation_criteria_id')->constrained();
>>>>>>>> 93afda1e219fd557fa375985732ec35f9cef7806:database/migrations/2024_03_19_095554_create_evaluations_table.php
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
