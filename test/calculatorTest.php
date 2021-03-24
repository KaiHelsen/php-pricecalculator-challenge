<?php
declare(strict_types=1);
require("./vendor/autoload.php");
use PHPUnit\Framework\TestCase;

//use cmd command ./vendor/bin/phpunit test
final class calculatorTest extends TestCase
{

    public function testIfThisWorksAtALL(): void
    {
        self::assertTrue(true);
    }
}