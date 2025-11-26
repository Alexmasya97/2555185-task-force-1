<?php
declare(strict_types=1);

namespace HtmlAcademy\Enums;

enum TaskStatus: string
{
    case NEW = 'new';
    case CANCELED = 'canceled';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    /**
     * Возвращает русскоязычное название статуса
     *
     * @return string название статуса на русском языке
     */
    public function statusMatchingRu(): string
    {
        return match ($this) {
            self::NEW => 'Новое',
            self::CANCELED => 'Отменено',
            self::IN_PROGRESS => 'В работе',
            self::COMPLETED => 'Выполнено',
            self::FAILED => 'Провалено',
        };
    }
}
