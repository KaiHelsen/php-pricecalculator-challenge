<?php
declare(strict_types=1);

namespace test;
require_once("./vendor/autoload.php");

use Models\DiscountCalculator;
use PHPUnit\Framework\TestCase;

//use cmd command ./vendor/bin/phpunit test
final class calculatorTest extends TestCase
{

    public function testIfThisWorksAtALL(): void
    {
        self::assertTrue(true);
    }

    public function provideTestData(): array
    {
        return [
            [6, 10, 4, 'FIXED', 'expect 6'],
            [0, 10, 12, 'FIXED', 'expect 0'],
            [20, 200, 90, 'VARIABLE', 'expect 20'],
            [0, 200, 110, 'VARIABLE', 'expect 0'],
            [10, 10, -2, 'FIXED', 'expect 12']
        ];
    }

    /**
     * @dataProvider  provideTestData
     * @param float $expectedResult
     * @param int $price
     * @param int $discount
     * @param string $type
     * @param string $expectMsg
     */
    public function testDiscountCalculator(float $expectedResult, int $price, int $discount, string $type, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertequals($expectedResult, $calculator->calculate($price, $discount, $type), $expectMsg);
    }

    public function testFixedDiscountSum() : void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals(20, $calculator->addDiscounts([10,5,4.5,.5]), 'expect 20');
    }

    public function testVariableDiscountMax() : void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals(20, $calculator->getMaxVariable([20,10,16,2.5,19.9,-25]), 'expect 20');
    }


}