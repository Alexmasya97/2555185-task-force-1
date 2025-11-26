<?php

namespace HtmlAcademy\Actions;

use HtmlAcademy\Enums\TaskStatus;

class CompleteAction extends AbstractAction
{
    public function getName(): string
    {
        return 'Выполнено';
    }

    public function getInternalName(): string
    {
        return 'complete';
    }

    public function checkRights(?int $executorId, int $customerId, int $currentUserId): bool
    {
        return $currentUserId === $customerId || $currentUserId === $executorId;
    }

    public function getNextStatus(): TaskStatus
    {
        return TaskStatus::COMPLETED;
    }
}
