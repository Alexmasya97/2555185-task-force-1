<?php
declare(strict_types=1);

namespace HtmlAcademy\Actions;

use HtmlAcademy\Enums\TaskStatus;

class RespondAction extends AbstractAction
{
    public function getName(): string
    {
        return 'Откликнуться';
    }

    public function getInternalName(): string
    {
        return 'respond';
    }

    public function checkRights(?int $executorId, int $customerId, int $currentUserId): bool
    {
        return $currentUserId !== $customerId;
    }

    public function getNextStatus(): TaskStatus
    {
        return TaskStatus::IN_PROGRESS;
    }
}
