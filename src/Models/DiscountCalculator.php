<?php
declare(strict_types=1);

namespace Models;

use function PHPUnit\Framework\throwException;

class DiscountCalculator
{

    /**
     * subtracts variable amount as percentage value from total value.
     * @param int $total
     * @param int $variableAmount
     * @return int
     */
    public static function subtractVariable(int $total, int $variableAmount): int
    {
        //here we subtract the variable discount (a percentage) from the total value.
        return (int)($total - ($total * $variableAmount / 100));
    }

    /**
     * subtracts a fixed amount from the total value
     * IMPORTANT! The total amount is assumed to be in cents/pennies, whereas the fixed amount is assumed to be in euros/dollars
     * @param int $total
     * @param int $fixedAmount
     * @return int
     */
    public static function subtractFixed(int $total, int $fixedAmount): int
    {
        //the total price is in cents, but discounts are recorded in full euros. So we must multiply the fixed amount by 100 to get the value in cents
        //this way we get the proper calculation.
        //the return value is then also in cents, as it should be.
        return ($total - ($fixedAmount * 100));
    }

    /**
     * calculates discount on a price
     *
     * @param int $price
     * @param Discount $discount
     * @return float|int
     */
    public static function calculate(int $price, Discount $discount): float|int
    {
        $discountValue = max(0, $discount->getAmount());
        if ($discount->isFixed())
        {
            return max(0, self::subtractFixed($price, $discountValue));
        }

        if ($discount->isVariable())
        {
            return max(0, self::subtractVariable($price, $discountValue));
        }

        throw new \InvalidArgumentException('Discount not of correct type');
    }

    /**
     * Calculate Group Discount takes in an array of Discount objects and figures out the best value related to the price.
     * for Fixed discounts, the function looks at the final total discount.
     * for Variable discounts, the function picks the highest variable discount.
     * Finally, it compares both discounts related to the price and returns a discount object which gives the best discount for its price.
     * @param int $price
     * @param array $groupDiscounts
     * @return Discount
     */
    public static function calculateGroupDiscount(int $price, array $groupDiscounts):
    Discount
    {
        //first, we have to make sure the price is not a negative value or zero.
        if ($price <= 0)
        {
            throw new \RangeException('price cannot be zero or less than zero');
        }

        $variableDiscount = 0;
        $fixedDiscount = 0;

        //next, we loop through the discounts and we add up all the fixed discounts and find the highest variable discount
        foreach ($groupDiscounts as $discount)
        {
            if ($discount->isVariable())
            {
                $variableDiscount = max($variableDiscount, $discount->getAmount());
            }

            if ($discount->isFixed())
            {
                $fixedDiscount += $discount->getAmount();
            }
        }

        //next, we calculate what the final price would be with the resulting fixed and variable discounts and see which one gives us the lowest possible price.
        //based on the lowest price, we return a discount object that gives us the lowest possible price.
        if (self::subtractFixed($price, $fixedDiscount) < self::subtractVariable($price, $variableDiscount))
        {
            return Discount::newFixedDiscount($fixedDiscount);
        }
        return Discount::newVariableDiscount($variableDiscount);
    }

    /**
     * Calculates the final price based on the combined group discount and customer discount
     * @param int $price
     * @param Discount $groupDiscount
     * @param Discount $customerDiscount
     * @return float final price in euros/dollars
     */
    public static function calculateCustomerDiscount(int $price, Discount $groupDiscount,
                                                     Discount $customerDiscount): float
    {
        //if the group discount is Fixed, it will always be the first to be calculated.
        //so it doesn't matter if the customerdiscount is fixed or variable, it can always be done last.
        if ($groupDiscount->isFixed())
        {
            $result = self::calculate($price, $groupDiscount);
            $result = self::calculate($result, $customerDiscount);
            return $result / 100;
        }

        //if the group discount is Variable, we need to check if the customer discount is Fixed or Variable.
        if ($groupDiscount->isVariable())
        {
            //if the customer discount is fixed, the customer discount is calculated first, and the group discount second.
            if ($customerDiscount->isFixed())
            {
                $result = self::calculate($price, $customerDiscount);
                $result = self::calculate($result, $groupDiscount);
                return $result / 100;
            }
            //if the customer discount is variable, we use the subtractmaxvariable function to easily find which of the two variable discounts is highest.
            if ($customerDiscount->isVariable())
            {
//                return round(self::calculate($price,max($customerDiscount->getAmount(), $groupDiscount->getAmount())),2);
                $result = round(min(self::calculate($price, $customerDiscount),
                    self::calculate($price, $groupDiscount)), 2);
                return $result / 100;
            }
        }

        //if after all this, we have not returned a price yet, then something has obviously gone wrong and we throw an exception.
        throw new \InvalidArgumentException("you dun goofed!");
    }

    /** the calculateBulkDiscount function is made to calculate whether an object becomes cheaper depending on the amount of it that has been ordered
     * it will decide this based on the quantity of the object and its original price, using internal logic to define when the price is lowered and by how much
     * I mean sure, we could have some additional database columns to define whether an item gets a bulk discount, for how many items and how much, but I'm lazy and I like math.
     * @param int $quantity
     * @param int $price
     * @return int the full price (with bulk discount) of the order, before customer and group discounts.
     */
    public static function calculateBulkDiscount(int $quantity, int $price): int
    {
        $bracket = (int)floor(log10(abs($quantity)));

        //I've never used a match before but this looks really convenient
        return match ($bracket)
        {
            2 => $quantity * ($price - 10),
            3 => $quantity * ($price - 30),
            4 => $quantity * ($price - 50),
            default => $quantity * $price,
        };

    }
}