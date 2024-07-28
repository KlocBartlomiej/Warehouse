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
        schema::create('produkt', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nazwa_produktu');
            $table->string('producent');
            $table->string('jednostka_ceny')->nullable();
            $table->double('waga')->nullable();
            $table->double('średnica')->nullable();
            $table->double('dlugość')->nullable();
            $table->double('szerokość')->nullable();
            $table->double('wysokość')->nullable();
            $table->double('grubość')->nullable();
            $table->string('typ_pakowania')->nullable();
            $table->integer('jednostka_zakupu')->nullable();
            $table->string('typ_jednostki_zakupu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produkt');
    }
};
