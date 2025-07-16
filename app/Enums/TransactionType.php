<?php

namespace App\Enums;

enum TransactionType: string
{
    case INCOME = 'income';
    case OUTCOME = 'outcome';



    /**
     * Get all the values for the enum.
     *
     * @return array Enum values.
     */
    public static function types(): array
    {
        return [
            self::INCOME->value,
            self::OUTCOME->value,
        ];
    }
}
