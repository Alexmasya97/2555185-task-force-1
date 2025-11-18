<?php
declare(strict_types=1);

namespace HtmlAcademy;
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
     * Возвращает список доступных действий для задачи в зависимости от её текущего статуса
     * @return array<TaskAction> Массив доступных действий (констант enum TaskAction)
     */
    public function getAvailableActions(): array
    {
        return match ($this->currentStatus) {
            TaskStatus::NEW => [TaskAction::RESPOND, TaskAction::CANCEL],
            TaskStatus::IN_PROGRESS => [TaskAction::COMPLETE, TaskAction::REFUSE],
            TaskStatus::COMPLETED, TaskStatus::CANCELED, TaskStatus::FAILED => [],
        };
    }

    /**
     * Возвращает следующий статус задачи после выполнения указанного действия
     *
     * @param TaskAction $action Действие, которое выполняется над задачей
     * @return TaskStatus|null Следующий статус или null, если действие не поддерживается
     */
    public function getNextStatus(TaskAction $action): ?TaskStatus
    {
        return match ($action) {
            TaskAction::CANCEL => TaskStatus::CANCELED,
            TaskAction::RESPOND => TaskStatus::IN_PROGRESS,
            TaskAction::COMPLETE => TaskStatus::COMPLETED,
            TaskAction::REFUSE => TaskStatus::FAILED,
            default => null,
        };
    }
    /**
     * Возвращает текущий статус задачи
     *
     * @return TaskStatus Текущий статус задачи
     */
    public function getCurrentStatus(): TaskStatus
    {
        return $this->currentStatus;
    }
}

