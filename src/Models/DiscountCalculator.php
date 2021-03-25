<?php
declare(strict_types=1);

namespace Models;

use function PHPUnit\Framework\throwException;

class DiscountCalculator
{

    public static function subtractVariable(int $total, int $variableAmount) : int
    {
        return (int)$total - ($total * $variableAmount / 100);
    }

    public static function subtractFixed(int $total, int $fixedAmount) : int
    {
        return ($total - ($fixedAmount * 100));
    }

    private static function subtractMaxVariable(int $total, int $firstVariableAmount, int $secondVariableAmount) : int
    {
        return min(self::subtractVariable($total, $firstVariableAmount), self::subtractVariable($total, $secondVariableAmount));
    }

    /**
     * calculates discount on a price
     *
     * @param int $price
     * @param Discount $discount
     * @return float|int
     */
    public function calculate(int $price, Discount $discount): float|int
    {
        $discountValue = max(0, $discount->getAMount());
        if($discount->isFixed())
        {
            return max(0,self::subtractFixed($price, $discountValue));
        }

        if($discount->isVariable())
        {
            return max(0,self::subtractVariable($price, $discountValue));
        }

        throw new \InvalidArgumentException('Discount not of correct type');
    }

    public function calculateGroupDiscount(int $price, array $groupDiscounts): Discount
    {
        if($price <= 0){
            throw new \RangeException('price cannot be zero or less than zero');
        }
        $variableDiscount = 0;
        $fixedDiscount = 0;

        foreach ($groupDiscounts as $discount)
        {

            if($discount->isVariable())
            {
                $variableDiscount = max($variableDiscount, $discount->getAmount());
            }

            if($discount->isFixed())
            {
                $fixedDiscount += $discount->getAmount();
            }
        }
        if (self::subtractFixed($price, $fixedDiscount) < self::subtractVariable($price, $variableDiscount))
        {
            return new Discount($fixedDiscount, Discount::FIXED);
        }
        return new Discount($variableDiscount, Discount::VARIABLE);
    }

    public function calculateCustomerDiscount(int $price, Discount $groupDiscount, Discount $customerDiscount): float
    {

        if ($groupDiscount->isFixed())
        {
                $result = $this->calculate($price, $groupDiscount);
                $result = $this->calculate($result, $customerDiscount);
                return $result/100;
        }

        if ($groupDiscount->isVariable())
        {
            if ($customerDiscount->isFixed())
            {
                $result = $this->calculate($price, $customerDiscount);
                $result = $this->calculate($result, $groupDiscount);
                return $result/100;
            }
            if ($customerDiscount->isVariable())
            {
                return round(self::subtractMaxVariable($price, $customerDiscount->getAmount(), $groupDiscount->getAmount())/100, 2);
            }

        }

        throw new \InvalidArgumentException("you dun goofed!");

    }
}