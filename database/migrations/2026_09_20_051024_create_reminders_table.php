<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Rappel concret attaché à une tâche. `dismissed_at` enregistre un rappel
     * écarté par l'utilisateur : c'est une action neutre, pas un manquement.
     */
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->string('anchor');
            $table->integer('offset_minutes');
            $table->string('channel');
            $table->datetime('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['scheduled_at', 'sent_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
