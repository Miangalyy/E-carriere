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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero_employer")->unique();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->date("date_naissance");
            $table->string("adresse");
            $table->string("telephone");
            $table->string("email");
            $table->date("date_embauche");
            $table->foreignId("fonction_id")->constrained();
            $table->foreignId("grade_id")->constrained();
            $table->foreignId("corps_id")->constrained();
            $table->string("photo")->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("fonction_id");
            $table->dropConstrainedForeignId("grade_id");
            $table->dropConstrainedForeignId("corps_id");

        });
        Schema::dropIfExists('employers');
    }
};