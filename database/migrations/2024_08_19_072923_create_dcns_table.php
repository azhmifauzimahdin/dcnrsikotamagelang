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
        Schema::create('dcns', function (Blueprint $table) {
            $table->id();
            $table->string('patsep', 20)->unique();
            $table->date('dcndate');
            $table->bigInteger('totalsubmitted');
            $table->bigInteger('totalapproved');
            $table->timestamps();

            $table->foreign('patsep')->references('patsep')->on('claims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcns');
    }
};
