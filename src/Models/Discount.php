<?php
declare(strict_types=1);

namespace Models;


class Discount
{
    public const FIXED = 'FIXED';
    public const VARIABLE = 'VARIABLE';
    private int $discount;
    private string $type;

    public function __construct(int $discount, string $type){
        $this->discount = $discount;
        $this->type = $type;
    }

    public function isVariable() : bool{
        return $this->type === self::VARIABLE;
    }

    public function isFixed() : bool{
        return $this->type === self::FIXED;
    }

    public function getDiscount() : float
    {
        return $this->discount;
    }
}