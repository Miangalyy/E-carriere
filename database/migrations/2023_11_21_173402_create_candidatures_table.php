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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero")->nullable();
            $table->foreignId("employer_id")->constrained();
            $table->foreignId("opportunite_id")->constrained();
            $table->string("statut");
            $table->date("date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("employer_id");
            $table->dropConstrainedForeignId("opportunite_id");
        });
        Schema::dropIfExists('candidatures');
    }
};