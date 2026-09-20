<?php

namespace App\Enums;

/**
 * Canal par lequel un rappel est délivré.
 *
 * Un seul canal est actif en v1. Les canaux à venir (mail, push) s'ajoutent ici
 * comme nouveaux cas, avec `isEnabled()` à false tant que l'envoi n'existe pas.
 */
enum ReminderChannel: string
{
    case Database = 'database';

    public function label(): string
    {
        return match ($this) {
            self::Database => 'Dans l\'application',
        };
    }

    /**
     * Le canal est-il réellement branché sur un envoi ?
     */
    public function isEnabled(): bool
    {
        return match ($this) {
            self::Database => true,
        };
    }
}
