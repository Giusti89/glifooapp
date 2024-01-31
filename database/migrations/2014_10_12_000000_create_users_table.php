<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'name'=> 'giusti',
            'email'=>'giusti.17@hotmail.com',
            'password'=>Hash::make('17041989'),
            'rol_id'=>'1',
            'cargo_id'=>'1',
        ],[
            'name'=> 'Glifoo',
            'email'=>'glifoo@hotmail.com',
            'password'=>Hash::make('tupaladin'),
            'rol_id'=>'1',
            'cargo_id'=>'1',
            'fotoPerfil'=>'./img/porDefecto/imagen1.jpg',
            'fondoPerfil'=>'./img/porDefecto/imagen1.jpg',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
