<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * `day_part` et `frequency` sont des colonnes `string` castées vers les enums
     * PHP DayPart et RoutineFrequency.
     *
     * `last_materialized_on` note jusqu'où les occurrences ont été générées : ce
     * n'est pas un indicateur d'assiduité, seulement un curseur technique.
     */
    public function up(): void
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->nullable()->constrained();
            $table->string('name');
            $table->string('day_part')->nullable();
            $table->string('frequency');
            $table->unsignedSmallInteger('interval')->default(1);
            $table->json('weekdays')->nullable();
            $table->unsignedTinyInteger('day_of_month')->nullable();
            $table->date('starts_on');
            $table->date('ends_on')->nullable();
            $table->time('suggested_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('last_materialized_on')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
