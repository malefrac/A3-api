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
        Schema::create('instructor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document')->unique()->comment('Cédula');
            $table->string('fullname')->comment('Nombre del instructor');
            $table->string('sena_email')->unique()->comment('Correo sena');
            $table->string('personal_email')->unique()->comment('Correo personal');
            $table->string('phone')->nullable()->comment('Teléfono');
            $table->string('password')->comment('Contraseña de acceso');
            $table->string('type')->comment('Tipo de contrato: PLANTA, CONTRATISTA');
            $table->string('profile')->comment('Perfil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor');
    }
};
