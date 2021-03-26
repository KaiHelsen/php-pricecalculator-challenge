<?php

namespace models;

use Models\Discount;
use PDO;

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private array $groupDiscounts;
    private Discount $customerDiscount;

    public function __construct(int $id, string $firstName, string $lastName, array $groupDiscounts, Discount $customerDiscount)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->groupDiscounts = $groupDiscounts;
        $this->customerDiscount = $customerDiscount;
    }

    static public function newCustomer(int $id, string $firstName, string $lastName) : Customer
    {
        return new Customer($id, $firstName, $lastName, [], Discount::newFixedDiscount(0));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    /** @return Discount[] */
    public function getGroupDiscounts(): array
    {
        return $this->groupDiscounts;
    }

    public function getCustomerDiscount(): Discount
    {
        return $this->customerDiscount;
    }

}