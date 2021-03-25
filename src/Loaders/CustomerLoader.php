<?php

namespace CustomerLoader;

use Discount;
use Models\Customer;
use PDO;

class CustomerLoader
{
    public static function fetchCustomer(int $id, PDO $pdo): Customer
    {
        $query = $pdo->prepare('select * from customer where id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawCustomer = $query->fetch();

        if ($rawCustomer['fixed_discount'] === null)  {
            $customerDiscount = new Discount(Discount::VARIABLE,
                (int)[$rawCustomer['variable_discount']]);
        }
        else {
            $customerDiscount = new Discount(Discount::FIXED,
                (int)[$rawCustomer['fixed_discount']]);
        }

        $groupDiscounts = \Loaders\DiscountLoader::fetchGroupDiscounts($rawCustomer['group_id'], $pdo);

        return new Customer($rawCustomer['id'], $rawCustomer['group_id'], $rawCustomer['firstname'],
            $rawCustomer['lastname'], $groupDiscounts, $customerDiscount);
    }

    /** @Customer[] */
    public static function fetchAllCustomers(PDO $pdo): array
    {
        $query = $pdo->query('select id, firstName, lastName from customer ORDER BY lastname, firstname');
        return $query->fetchAll();
    }
}