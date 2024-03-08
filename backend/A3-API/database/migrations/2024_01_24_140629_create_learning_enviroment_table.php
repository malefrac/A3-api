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
        Schema::create('learning_enviroment', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('Nombre del ambiente');
            $table->integer('capacity')->nullable()->comment('Capacidad');
            $table->integer('area_mt2')->nullable()->comment('Area en mt2');
            $table->integer('floor')->comment('Piso');
            $table->string('inventory')->comment('Inventario');
            $table->foreignId('type_id')->constrained('enviroment_type')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('location_id')->constrained('location')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('status')->comment('Estado: ACTIVO, INACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_enviroment');
    }
};
