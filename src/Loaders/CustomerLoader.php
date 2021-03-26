<?php

namespace Loaders;

use Models\Discount;
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

        if ($rawCustomer['fixed_discount'] !== null)  {
            $customerDiscount = Discount::newFixedDiscount((int)$rawCustomer['fixed_discount']);
        }
        else {
            $customerDiscount = Discount::newVariableDiscount((int)$rawCustomer['variable_discount']);
        }

        $groupDiscounts = \Loaders\DiscountLoader::fetchGroupDiscounts($rawCustomer['group_id'], $pdo);

        return new Customer($rawCustomer['id'], $rawCustomer['firstname'],
            $rawCustomer['lastname'], $groupDiscounts, $customerDiscount);
    }

    /** @Customer[]
     * @param PDO $pdo
     * @return array
     */
    public static function fetchAllCustomers(PDO $pdo): array
    {
        $query = $pdo->query('select id, firstName, lastName from customer ORDER BY lastname, firstname');
        $rawCustomerData =  $query->fetchAll();
        $customers = [];
        foreach($rawCustomerData as $i=>$customer)
        {
            $customers[] = Customer::newCustomer((int)$customer['id'], $customer['firstName'], $customer['lastName']);
        }
        return $customers;
    }
}