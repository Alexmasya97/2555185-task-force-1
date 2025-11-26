<?php

namespace HtmlAcademy\Actions;

use HtmlAcademy\Enums\TaskStatus;

class RefuseAction extends AbstractAction
{
    public function getName(): string
    {
        return 'Отказаться';
    }

    public function getInternalName(): string
    {
        return 'refuse';
    }

    public function checkRights(?int $executorId, int $customerId, int $currentUserId): bool
    {
        return $currentUserId === $executorId;
    }

    public function getNextStatus(): TaskStatus
    {
        return TaskStatus::FAILED;
    }
}
