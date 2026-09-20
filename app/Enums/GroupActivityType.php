<?php

namespace App\Enums;

/**
 * Nature d'une entrée du flux d'activité d'un groupe.
 *
 * Contrainte produit : aucun cas négatif ou punitif ne doit être ajouté ici.
 * Le flux montre ce que le groupe a fait avancer, jamais ce qu'un membre n'a
 * pas fait.
 */
enum GroupActivityType: string
{
    case TaskCompleted = 'task_completed';

    case TaskAssigned = 'task_assigned';

    case MemberJoined = 'member_joined';

    /**
     * Clé de traduction utilisée par défaut pour la colonne `label_key`.
     */
    public function defaultLabelKey(): string
    {
        return match ($this) {
            self::TaskCompleted => 'group.activity.task_completed',
            self::TaskAssigned => 'group.activity.task_assigned',
            self::MemberJoined => 'group.activity.member_joined',
        };
    }
}
