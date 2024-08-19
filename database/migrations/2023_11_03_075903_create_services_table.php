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
        //numero_service", "titre", "description", "direction"
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero_service")->unique();
            $table->string("titre");
            $table->string("description");
            $table->foreignId("direction_id")->constrained();
            $table->string("responsable");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("direction_id");
        });
        Schema::dropIfExists('services');
    }
};