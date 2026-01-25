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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->enum('type_public', ['homme', 'femme']);
            $table->time('heure_ouverture');
            $table->time('heure_fermeture');
            $table->boolean('is_closed')->default(false);
            $table->text('motif_fermeture')->nullable();
            $table->timestamps();
            
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
