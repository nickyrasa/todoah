<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * L'avancement d'un projet n'est pas stocké : il se recalcule depuis les
     * tâches (voir Project::progressPercent()). Aucune colonne de statut, donc
     * aucune valeur ne peut désigner un projet « en retard ».
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->nullable()->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('due_on')->nullable();
            $table->timestamp('ai_breakdown_requested_at')->nullable();
            $table->timestamp('ai_breakdown_completed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamps();

            $table->index(['user_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
