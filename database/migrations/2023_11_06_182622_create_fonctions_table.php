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
        //"titre", "description", "service_associer"
        Schema::create('fonctions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("titre");
            $table->string("numero_fonction");
            $table->string("description");
            $table->foreignId("service_id")->contrained();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("service_id");
        });
        Schema::dropIfExists('fonctions');
    }
};