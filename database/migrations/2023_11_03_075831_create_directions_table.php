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
        //"numero", "titre", "description", "responsable"
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero_direction")->unique();
            $table->string("titre");
            $table->string("description");
            $table->string('responsable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directions');
    }
};