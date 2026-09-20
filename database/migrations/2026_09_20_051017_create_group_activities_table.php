<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * `type` est une colonne `string` castée vers l'enum PHP GroupActivityType :
     * pas d'enum SQL, la liste des cas évolue sans migration.
     *
     * Le couple `subject_type` / `subject_id` est une référence polymorphe
     * volontairement sans clé étrangère : le sujet peut disparaître sans effacer
     * la trace de l'activité.
     */
    public function up(): void
    {
        Schema::create('group_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('actor_id')->constrained('users');
            $table->string('type');
            $table->string('label_key');
            $table->json('label_params')->nullable();
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->datetime('occurred_at');
            $table->timestamps();

            $table->index(['group_id', 'occurred_at']);
            $table->index(['subject_type', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_activities');
    }
};
