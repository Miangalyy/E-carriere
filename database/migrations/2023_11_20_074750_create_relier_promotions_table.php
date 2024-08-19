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
        Schema::create('relier_promotions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero");
            $table->foreignId("employer_id")->constrained();
            $table->foreignId("promotion_id")->constrained();
            $table->string("motif");
            $table->date("date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("promotion_id");
            $table->dropConstrainedForeignId("employer_id");
        });
        Schema::dropIfExists('relier_promotions');
    }
};