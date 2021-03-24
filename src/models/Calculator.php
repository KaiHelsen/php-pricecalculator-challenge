<?php
declare(strict_types=1);
namespace ComposerIncludeFiles\models;

use http\Exception\InvalidArgumentException;

class Calculator
{
    private const FIXED = 'FIXED';
    private const VARIABLE = 'VARIABLE';

    public function calculate(int $price, int $discount, string $type) : int
    {
        switch($type){
            case self::FIXED:
                $result = $price - $discount;
                break;
            case self::VARIABLE:
                $result = $price - ($price * $discount) / 100;
                break;
            DEFAULT:
                throw new \InvalidArgumentException(sprintf('incorrect calculation type %s entered. %s or %s expected.', $type, self::FIXED, self::VARIABLE));
        }
        return max(0,$price - $discount);
    }
}