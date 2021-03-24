<?php
declare(strict_types=1);

abstract class loader
{
    abstract function fetchAll() :? array;
    abstract function fetchById(int $id) :? array;
}