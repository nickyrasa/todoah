<?php

namespace App\Enums;

/**
 * Nature d'un événement du journal de progression.
 *
 * Contrainte produit : aucun cas négatif ou punitif ne doit être ajouté ici.
 * Le journal ne raconte que ce qui a avancé — il n'enregistre jamais un oubli,
 * un retard ou une perte. Un événement n'accorde donc jamais d'XP négatif.
 */
enum ProgressionEventType: string
{
    case TaskCompleted = 'task_completed';

    case LevelUp = 'level_up';

    case MilestoneReached = 'milestone_reached';

    case RoutineStreakMaintained = 'routine_streak_maintained';

    /**
     * XP accordé par défaut par un événement de ce type. Toujours >= 0.
     */
    public function defaultXpAward(): int
    {
        return match ($this) {
            self::TaskCompleted => 10,
            self::LevelUp => 0,
            self::MilestoneReached => 25,
            self::RoutineStreakMaintained => 15,
        };
    }

    /**
     * Clé de traduction utilisée par défaut pour la colonne `label_key`.
     */
    public function defaultLabelKey(): string
    {
        return match ($this) {
            self::TaskCompleted => 'progression.task_completed',
            self::LevelUp => 'progression.level_up',
            self::MilestoneReached => 'progression.milestone_reached',
            self::RoutineStreakMaintained => 'progression.routine_streak_maintained',
        };
    }
}
