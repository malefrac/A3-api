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
        Schema::create('scheduling_enviroment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('instructor_id')->constrained('instructor')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->date('date_scheduling')->comment('Fecha de planificación');
            $table->time('initial_hour')->comment('Hora inicial');
            $table->time('final_hour')->comment('Hora final');
            $table->foreignId('enviroment_id')->constrained('learning_enviroment')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduling_enviroment');
    }
};
