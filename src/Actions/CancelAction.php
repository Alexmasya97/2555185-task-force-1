<?php

namespace HtmlAcademy\Actions;

use HtmlAcademy\Enums\TaskStatus;

class CancelAction extends AbstractAction
{
    public function getName(): string
    {
        return 'Отменить';
    }

    public function getInternalName(): string
    {
        return 'cancel';
    }

    public function checkRights(?int $executorId, int $customerId, int $currentUserId): bool
    {
        // Отменить может только автор задания
        return $currentUserId === $customerId;
    }

    public function getNextStatus(): TaskStatus
    {
        return TaskStatus::CANCELED;
    }
}
