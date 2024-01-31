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
        Schema::create('subproducts', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->decimal('costo', 10, 2)->default(0.00);

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

// Schema::dropIfExists('subproducts');

        Schema::table('subproducts', function (Blueprint $table) {
            // Eliminar la clave foránea si existe
            $table->dropForeign(['producto_id']);
    
            // Eliminar la tabla subproducts
            $table->dropIfExists('subproducts');
        });
    }
};