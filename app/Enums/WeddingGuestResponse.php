<?php

namespace App\Enums;

enum WeddingGuestResponse: int
{
    case PENDING = 0;
    case WILL = 1;
    case WILL_NOT = 2;

    public function label(): string
    {
        return trans(match ($this) {
            self::PENDING => 'Pending',
            self::WILL => 'Will',
            self::WILL_NOT => 'Will not',
        });
    }
}
