<?php

namespace App\Enums;

/**
 * Moment de la journée auquel une tâche ou une routine est rattachée.
 *
 * Volontairement grossier (trois moments, pas une heure précise) : un créneau
 * flou est plus tenable qu'un horaire exact pour un profil TDA/TDAH.
 */
enum DayPart: string
{
    case Morning = 'morning';

    case Afternoon = 'afternoon';

    case Evening = 'evening';

    public function label(): string
    {
        return match ($this) {
            self::Morning => 'Matin',
            self::Afternoon => 'Après-midi',
            self::Evening => 'Soir',
        };
    }

    /**
     * Heure de départ indicative du créneau, au format HH:MM.
     */
    public function defaultSuggestedTime(): string
    {
        return match ($this) {
            self::Morning => '08:00',
            self::Afternoon => '14:00',
            self::Evening => '20:00',
        };
    }
}
