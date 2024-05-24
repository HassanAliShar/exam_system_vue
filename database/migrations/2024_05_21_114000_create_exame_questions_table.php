<?php

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
        Schema::create('exame_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_id')->constrained()->onDelete('cascade');
            $table->string('question', 255);
            $table->string('option1', 255)->nullable();
            $table->string('option2', 255)->nullable();
            $table->string('option3', 255)->nullable();
            $table->string('option4', 255)->nullable();
            $table->string('answer', 255)->nullable();
            $table->string('answer_explaination', 255)->nullable();
            $table->string('question_type', 255);
            $table->string('marks', 255);
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
        Schema::dropIfExists('exame_questions');
    }
};
