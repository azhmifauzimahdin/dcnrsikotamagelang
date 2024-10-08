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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('admdatetime', 40);
            $table->string('disdatetime', 40);
            $table->integer('patid');
            $table->string('patname', 125);
            $table->string('patsep', 20)->unique();
            $table->bigInteger('totalrajal')->default(0);
            $table->bigInteger('totalbayi')->default(0);
            $table->timestamps();

            $table->foreign('patsep')->references('patsep')->on('claims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
