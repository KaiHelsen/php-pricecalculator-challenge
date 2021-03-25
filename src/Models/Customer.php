<?php

namespace models;

use Discount;
use PDO;

class Customer
{
    private pdo $pdo;
    private int $id;
    private int $groupId;
    private string $firstName;
    private string $lastName;
    private array $groupDiscounts;
    private Discount $customerDiscount;

    public function __construct(int $id, int $groupId, string $firstName, string $lastName, array $groupDiscounts, Discount $customerDiscount)
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->groupDiscounts = $groupDiscounts;
        $this->customerDiscount = $customerDiscount;
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

    public function getGroupId(): int
    {
        return $this->groupId;
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