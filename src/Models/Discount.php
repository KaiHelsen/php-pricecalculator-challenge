<?php
declare(strict_types=1);

namespace Models;

class Discount
{
    private const VARIABLE = 'VARIABLE';
    private const FIXED = 'FIXED';

    private string $type;
    private int $amount;

    /**
     * Discount constructor.
     * @param string $type
     * @param int $amount
     */
    public function __construct(int $amount, string $type = self::FIXED)
    {
        $this->type = $type;
        $this->amount = $amount;
    }

    public static function newVariableDiscount(int $amount): Discount
    {
        return new Discount($amount, self::VARIABLE);
    }

    public static function newFixedDiscount(int $amount): Discount
    {
        return new Discount($amount, self::FIXED);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function isFixed(): bool
    {
        return $this->type === self::FIXED;
    }

    public function isVariable(): bool
    {
        return $this->type === self::VARIABLE;
    }


}