<?php
Namespace models;

class Customer
{
    private pdo $pdo;
    private int $id;
    private string $firstName;
    private string $lastName;
    private ?int $fixedDiscount;
    private ?int $variableDiscount;

    public function __construct(int $id, string $firstName, string $lastName, ?int $fixedDiscount, ?int $variableDiscount)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->fixedDiscount = $fixedDiscount;
        $this->variableDiscount = $variableDiscount;
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

    public function getFixedDiscount(): ?int
    {
        return $this->fixedDiscount;
    }

    public function getVariableDiscount(): ?int
    {
        return $this->variableDiscount;
    }
}