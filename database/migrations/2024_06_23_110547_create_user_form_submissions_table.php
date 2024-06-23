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
        Schema::create('user_form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->references('id')->on('polls');
            $table->string('username');
            $table->string('course_name');
            $table->date('course_date');
            $table->string('center');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_form_submission');
    }
};
