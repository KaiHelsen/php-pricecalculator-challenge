<?php
declare(strict_types=1);

namespace Models;

use function PHPUnit\Framework\throwException;

class DiscountCalculator
{
    const FIXED = 'FIXED';
    const VARIABLE = 'VARIABLE';

    /**
     * calculates discount on a price
     *
     * @param int $price
     * @param float $discount
     * @param string $type
     * @return float
     */
    public function calculate(int $price, float $discount, string $type): float
    {
        $result = $price;
        $discount = (Max(0, $discount));
        switch ($type)
        {
            case (self::FIXED):
                $result = $price - $discount;
                break;
            case (self::VARIABLE):
                $result = $price - (($price * $discount) / 100);
                break;
            default:
                //no recognized command! throw exception!
                throw new \InvalidArgumentException(sprintf('incorrect calculation type %s entered. %s or %s expected.', $type, self::FIXED, self::VARIABLE));
        }
        return (Max($result, 0));
    }

    public function addDiscounts(array $discounts): float
    {
        return array_sum($discounts);
    }

    public function getMaxVariable(array $discounts): float
    {
        return max($discounts);
    }

    public function calculateGroupDiscount(int $price, float $fixedDiscount, float $variableDiscount): array
    {
        $fixedResult = $this->calculate($price, $fixedDiscount, self::FIXED);
        $variableResult = $this->calculate($price, $variableDiscount, self::VARIABLE);
        if ($fixedResult > $variableResult)
        {
            return [$variableResult,self::VARIABLE];
        }
        return [$fixedResult,self::FIXED];
    }

    public function calculateCustomerDiscount(int $price, float $groupDiscount, string $groupDiscountType, float $customerDiscount, string $customerDiscountType): float
    {
        if($groupDiscountType === self::FIXED){
            if($customerDiscountType === self::FIXED)
            {
                return $price - $groupDiscount - $customerDiscount;
            }
            if($customerDiscountType === self::VARIABLE)
            {
                $result = $price - $groupDiscount;
                return $result - ($result * $customerDiscount / 100);

            }
        }

        if($groupDiscountType === self::VARIABLE)
        {
            if($customerDiscountType === self::FIXED)
            {
                $result = $price - $customerDiscount;
                return $result - ($result * $groupDiscount / 100);

            }
            if($customerDiscountType === self::VARIABLE)
            {
                return $price - ($price * (max($groupDiscount, $customerDiscount)) / 100);
            }

        }

        throw new \InvalidArgumentException("you dun goofed!");


    }
}