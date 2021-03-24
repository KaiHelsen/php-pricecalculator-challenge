<?php


class CustomerLoader
{
    public static function getCustomer(int $id, PDO $pdo): Customer
    {
        $query = $pdo->prepare('select * from customer where id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawCustomer = $query->fetch();

        return new Customer($rawCustomer['id'], $rawCustomer['firstname'], $rawCustomer['lastname'], $rawCustomer['fixed_discount'], $rawCustomer['variable_discount']);
    }

    /** @Customer[] */
    public static function getAllCustomers(PDO $pdo): array
    {
        $query = $pdo->query('select * from customer ORDER BY lastname, firstname');
        $rawCustomers = $query->fetchAll();

        $customers = [];
        foreach ($rawCustomers as $customer) {
            $customers[] = new Customer($customer['id'], $customer['firstname'],
                $customer['lastname'], $customer['fixed_discount'], $customer['variable_discount']);
        }

        return $customers;
    }
}