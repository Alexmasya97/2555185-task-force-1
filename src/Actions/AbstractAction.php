<?php

declare(strict_types=1);

namespace HtmlAcademy\Actions;

use HtmlAcademy\Enums\TaskStatus;

abstract class AbstractAction
{
    abstract public function getName(): string;

    abstract public function getInternalName(): string;

    abstract public function checkRights(?int $executorId, int $customerId, int $currentUserId): bool;

    abstract public function getNextStatus(): TaskStatus;
}
