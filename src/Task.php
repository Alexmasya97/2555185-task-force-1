<?php
declare(strict_types=1);

namespace HtmlAcademy;

use HtmlAcademy\Actions\AbstractAction;
use HtmlAcademy\Actions\RespondAction;
use HtmlAcademy\Actions\CancelAction;
use HtmlAcademy\Actions\CompleteAction;
use HtmlAcademy\Actions\RefuseAction;
use HtmlAcademy\Enums\TaskStatus;

class Task
{
    private TaskStatus $currentStatus;
    private ?int $executorId;
    private int $customerId;

    public function __construct(int $customerId, ?int $executorId = null)
    {
        $this->currentStatus = TaskStatus::NEW;
        $this->customerId = $customerId;
        $this->executorId = $executorId;
    }

    /**
     * Возвращает список доступных действий
     *
     * @param int $currentUserId ID текущего пользователя
     * @return array<AbstractAction> Массив доступных действий
     */
    public function getAvailableActions(int $currentUserId): array
    {
        $actionsByStatus = match ($this->currentStatus) {
            TaskStatus::NEW => [new RespondAction(), new CancelAction()],
            TaskStatus::IN_PROGRESS => [new CompleteAction(), new RefuseAction()],
            TaskStatus::COMPLETED, TaskStatus::CANCELED, TaskStatus::FAILED => [],
        };

        // Фильтруем действия по правам пользователя
        return array_filter(
            $actionsByStatus,
            fn($action) => $action->checkRights(
                $this->executorId,
                $this->customerId,
                $currentUserId
            )
        );
    }

    public function getNextStatus(AbstractAction $action): ?TaskStatus
    {
        return $action->getNextStatus();
    }

    public function getCurrentStatus(): TaskStatus
    {
        return $this->currentStatus;
    }

    public function setStatus(TaskStatus $status): void
    {
        $this->currentStatus = $status;
    }

    public function setExecutorId(int $executorId): void
    {
        $this->executorId = $executorId;
    }

    public function getExecutorId(): ?int
    {
        return $this->executorId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }
}
