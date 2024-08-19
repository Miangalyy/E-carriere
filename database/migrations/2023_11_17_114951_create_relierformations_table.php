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
        Schema::create('relierformations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero");
            $table->foreignId("formation_id")->constrained();
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
            $table->dropConstrainedForeignId("formation_id");
            $table->dropConstrainedForeignId("employer_id");
        });
        Schema::dropIfExists('relierformations');
    }
};