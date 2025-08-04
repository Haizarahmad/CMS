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
        Schema::dropIfExists('student_exam');
        Schema::dropIfExists('subject_result');
        Schema::dropIfExists('results');
        Schema::dropIfExists('exams');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
