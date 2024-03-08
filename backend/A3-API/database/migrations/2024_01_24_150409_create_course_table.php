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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique()->comment('Ficha');
            $table->string('shift')->comment('Jornada: DIURNA, MIXTA, NOCTURNA');
            $table->foreignId('career_id')->constrained('career')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->date('initial_date')->comment('Fecha inicial');
            $table->date('final_date')->comment('Fecha final');
            $table->string('status')->comment('Estado: LECTIVA, PRODUCTIVA, INDUCCIÓN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
