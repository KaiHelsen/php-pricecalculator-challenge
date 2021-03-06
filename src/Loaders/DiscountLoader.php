<?php

namespace Loaders;

use Models\Discount;

class DiscountLoader
{
    /**
     * @param int $groupId
     * @param $pdo
     * @return Discount[]
     */
    public static function fetchGroupDiscounts (int $groupId, $pdo): array
    {
        $query = $pdo->prepare('with recursive discounts (id, fixed_discount, variable_discount, parent_id) as (
        select cg.id,
           cg.fixed_discount,
           cg.variable_discount,
           cg.parent_id
    from customer_group cg
    where cg.id = :groupId
    union all
    select cgp.id,
           cgp.fixed_discount,
           cgp.variable_discount,
           cgp.parent_id
    from customer_group cgp
             inner join discounts
                        on cgp.id = discounts.parent_id
)
select *
from discounts');
        $query->bindValue('groupId', $groupId);
        $query->execute();
        $rawDiscounts = $query->fetchAll();

        $groupDiscounts = [];

        foreach ($rawDiscounts as $discount) {
            if ($discount['fixed_discount'] !== null)  {
                $groupDiscounts[] = Discount::newFixedDiscount((int)$discount['fixed_discount']);
            }
            else {
                $groupDiscounts[] = Discount::newVariableDiscount((int)$discount['variable_discount']);
            }
        }

        return $groupDiscounts;
    }
}