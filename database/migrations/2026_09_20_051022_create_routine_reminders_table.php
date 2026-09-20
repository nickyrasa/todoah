<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Modèle de rappel porté par la routine : recopié sur chaque tâche générée
     * (table `reminders`). `offset_minutes` est signé — négatif = avant l'ancrage.
     */
    public function up(): void
    {
        Schema::create('routine_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routine_id')->constrained();
            $table->string('anchor');
            $table->integer('offset_minutes');
            $table->string('channel');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_reminders');
    }
};
