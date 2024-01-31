<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        DB::table('cargos')->insert([
            ['nombre' => 'Director General'],
            ['nombre' => 'Estratega'],
            ['nombre' => 'Asistente de Producción'],
            ['nombre' => 'Productor'],            
            ['nombre' => 'Programador'],
            ['nombre' => 'Asistente de Programación'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
