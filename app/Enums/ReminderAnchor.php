<?php

namespace App\Enums;

/**
 * Palier de rappel : point d'ancrage temporel auquel se rattache un rappel.
 *
 * Le décalage (`offset_minutes`) se compte à partir de cet ancrage, en minutes
 * signées : négatif = avant l'ancrage, positif = après.
 */
enum ReminderAnchor: string
{
    case BeforeStart = 'before_start';

    case AtStart = 'at_start';

    case Midpoint = 'midpoint';

    case BeforeEnd = 'before_end';

    public function label(): string
    {
        return match ($this) {
            self::BeforeStart => 'Un peu avant',
            self::AtStart => 'Au moment de commencer',
            self::Midpoint => 'À mi-parcours',
            self::BeforeEnd => 'Avant la fin du créneau',
        };
    }

    /**
     * Décalage proposé par défaut pour ce palier, en minutes signées.
     */
    public function defaultOffsetMinutes(): int
    {
        return match ($this) {
            self::BeforeStart => -15,
            self::AtStart, self::Midpoint => 0,
            self::BeforeEnd => -10,
        };
    }
}
