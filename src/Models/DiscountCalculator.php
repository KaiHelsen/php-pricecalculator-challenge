<?php
declare(strict_types=1);
namespace Models;

class DiscountCalculator
{
    private const FIXED = 'FIXED';
    private const VARIABLE = 'VARIABLE';

    public function calculate(int $price, float $discount, string $type) : float
    {
        $result = $price;
        $discount = (Max(0,$discount));
        switch($type){
            case (self::FIXED):
                $result = $price - $discount;
                break;
            case (self::VARIABLE):
                $result = $price - (($price * $discount) / 100);
                break;
            DEFAULT:
                throw new \InvalidArgumentException(sprintf('incorrect calculation type %s entered. %s or %s expected.', $type, self::FIXED, self::VARIABLE));
        }
        return (Max($result, 0));
    }

    public function addDiscounts(array $discounts) : float
    {
        return array_sum($discounts);
    }

    public function getMaxVariable(array $discounts) : float
    {
        return max($discounts);
    }
}