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
        Schema::create('assign_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->bigInteger('attempt')->default(1);
            $table->bigInteger('marked_attempts')->default(0);
            $table->bigInteger('total_marks')->nullable();
            $table->bigInteger('passing_marks')->default(0);
            $table->string('status',100)->default(0);
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
        Schema::dropIfExists('assign_exame');
    }
};
