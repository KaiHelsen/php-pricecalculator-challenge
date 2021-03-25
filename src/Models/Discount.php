<?php
declare(strict_types=1);

namespace Models;

class Discount
{
    public const VARIABLE = 'VARIABLE';
    public const FIXED = 'FIXED';

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

    public function getType(): string
    {
        return $this->type;
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