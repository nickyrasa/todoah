<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Pas de colonne de statut : une tâche est décrite par des horodatages
     * positifs (`completed_at`, `skipped_at`, `snoozed_until`). Il n'existe donc
     * aucune valeur stockée signifiant « manquée » ou « en retard » — le retard
     * éventuel se déduit à la volée (voir Task::isOverdue()).
     *
     * Pas de SoftDeletes non plus : suppression réelle en v1 (décision produit).
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('created_by_user_id')->constrained('users');
            $table->foreignId('group_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('routine_id')->nullable()->constrained();
            $table->string('title');
            $table->text('notes')->nullable();
            $table->string('day_part')->nullable();
            $table->date('scheduled_for')->nullable();
            $table->datetime('scheduled_at')->nullable();
            $table->unsignedSmallInteger('estimated_minutes')->nullable();
            $table->unsignedSmallInteger('position')->default(0);
            $table->boolean('is_ai_suggested')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('skipped_at')->nullable();
            $table->timestamp('snoozed_until')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'scheduled_for']);
            $table->index(['user_id', 'completed_at']);
            $table->index('project_id');
            $table->unique(['routine_id', 'scheduled_for']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
