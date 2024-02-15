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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('year_count');
            $table->integer('semester_count');
            $table->integer('subject_count');
            $table->integer('question_count');
            $table->integer('semester_year_count');
            $table->integer('subject_year_count');
            $table->integer('have_exam_subjects_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
