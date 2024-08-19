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
        Schema::create('rilier_experiences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero");
            $table->foreignId("experience_id")->constrained();
            $table->string("description");
            $table->string("nom_entreprise");
            $table->foreignId("employer_id")->constrained();
            $table->date("date_debut");
            $table->date("date_fin");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("experience_id");
            $table->dropConstrainedForeignId("employer_id");
        });
        Schema::dropIfExists('rilier_experiences');
    }
};