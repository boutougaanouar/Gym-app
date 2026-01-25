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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->text('description')->nullable();
            $table->foreignId('coach_id')->nullable()->constrained()->onDelete('set null');
            $table->string('couleur')->default('#10b981');
            $table->integer('max_participants')->nullable();
            $table->timestamps();
            
            $table->index(['date', 'heure_debut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
