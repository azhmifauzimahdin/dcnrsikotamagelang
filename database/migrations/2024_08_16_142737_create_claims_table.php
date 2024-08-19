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
        Schema::create('claims', function (Blueprint $table) {
            $table->string('patsep', 20)->unique();
            $table->string('admdatetime', 40);
            $table->string('disdatetime', 40);
            $table->integer('patid');
            $table->string('patname', 125);
            $table->bigInteger('totalbpjs');
            $table->bigInteger('totalrs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
