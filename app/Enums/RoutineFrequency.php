<?php

namespace App\Enums;

/**
 * Rythme de répétition d'une routine.
 */
enum RoutineFrequency: string
{
    case Daily = 'daily';

    case Weekly = 'weekly';

    case Monthly = 'monthly';

    public function label(): string
    {
        return match ($this) {
            self::Daily => 'Chaque jour',
            self::Weekly => 'Chaque semaine',
            self::Monthly => 'Chaque mois',
        };
    }

    /**
     * La colonne `weekdays` n'a de sens que pour une routine hebdomadaire.
     */
    public function usesWeekdays(): bool
    {
        return $this === self::Weekly;
    }

    /**
     * La colonne `day_of_month` n'a de sens que pour une routine mensuelle.
     */
    public function usesDayOfMonth(): bool
    {
        return $this === self::Monthly;
    }

    /**
     * Unité de date à laquelle s'applique la colonne `interval`.
     */
    public function dateUnit(): string
    {
        return match ($this) {
            self::Daily => 'day',
            self::Weekly => 'week',
            self::Monthly => 'month',
        };
    }
}
