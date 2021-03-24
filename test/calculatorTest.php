<?php
declare(strict_types=1);

namespace test;
require_once ("./vendor/autoload.php");

//use ComposerIncludeFiles\models\Calculator;
use PHPUnit\Framework\TestCase;

//use cmd command ./vendor/bin/phpunit test
//remember to preface test functions with 'test' or else it won't work.
final class calculatorTest extends TestCase
{

    public function testIfThisWorksAtALL(): void
    {
        self::assertTrue(true);
    }

    public function provideCalcTestData(): array
    {
        return [
            [6, 10, 4, 'FIXED', 'expect 6'],
            [0, 10, 12, 'FIXED', 'expect 0'],
            [20, 200, 90, 'VARIABLE', 'expect 20'],
            [0, 200, 110, 'VARIABLE', 'expect 0'],
            [10, 10, -2, 'FIXED', 'expect 10']
        ];
    }

    /**
     * @dataProvider  provideCalcTestData
     * @param float $expectedResult
     * @param int $price
     * @param int $discount
     * @param string $type
     * @param string $expectMsg
     */
    public function testDiscountCalculator(float $expectedResult, int $price, int $discount, string $type, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculate($price, $discount, $type), $expectMsg);
    }

    public function provideGroupDiscountTestData(): array
    {
        return [
            [[10, DiscountCalculator::FIXED], 20, 10, 25, 'expect 10, FIXED'],     //assuming that the function will pick the discount which gives the most value to the customer / gives the lowest end result
            [[10, DiscountCalculator::VARIABLE], 20, 2, 50, 'expect 10, VARIABLE'],
            [[15, DiscountCalculator::VARIABLE], 20, 2, 25, 'expect 15, VARIABLE'],
            [[10, DiscountCalculator::FIXED], 20, 10, 50, 'expect 10, FIXED'],
            [[0, DiscountCalculator::FIXED], -20, 10, 25, 'expect 0, FIXED'],
            [[0, DiscountCalculator::VARIABLE], 20, -10, 120, 'expect 0, FIXED']
        ];
    }

    /**
     * @dataProvider  provideGroupDiscountTestData
     */
    public function testGroupDiscount(array $expectedResult, int $price, float $fixedDiscount, float $variableDiscount, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculateGroupDiscount($price, $fixedDiscount, $variableDiscount), $expectMsg);
    }

    public function provideFullDiscountTestData() : array
    {
        return[
            [20, 40, 10, 'FIXED', 10, 'FIXED', 'expect 20'],
            [15,40 ,10, 'FIXED', 50, 'VARIABLE', 'expect 15'],
            [0,40 ,40, 'FIXED', 100, 'VARIABLE', 'expect 0'],
            [30,40,10, 'VARIABLE', 25, 'VARIABLE', 'expect 30'],
            [40,40,0, 'VARIABLE', 0, 'VARIABLE', 'expect 40'],
//            [40,40,0, 'VARIABLE', 16, 'SMURF', 'expect error: you dun goofed'],
            [27 ,40, 25, 'VARIABLE', 4, 'FIXED', 'expect 27'],
            [25.2 ,40, 30, 'VARIABLE', 4, 'FIXED', 'expect 25.2'],

            ];
    }
    /**
     * @dataProvider provideFullDiscountTestData
     * @param float $expectedResult
     * @param int $price
     * @param float $groupDiscount
     * @param string $groupDiscountType
     * @param float $customerDiscount
     * @param string $customerDiscountType
     * @param string $expectMsg
     */
    public function testFullDiscountCalculation(float $expectedResult, int $price, float $groupDiscount, string $groupDiscountType, float $customerDiscount, string $customerDiscountType, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculateCustomerDiscount($price, $groupDiscount, $groupDiscountType, $customerDiscount, $customerDiscountType), $expectMsg);
    }

//    public function testDiscountCalculatorException(float $expectedResult, int $price, int $discount, string $type, string $expectedMsg) : void
//    {
//
//        $calculator = new DiscountCalculator;
//        self::expectException($calculator->calculate($price, $discount, $type));
//    }

    public function testFixedDiscountSum(): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals(20, $calculator->addDiscounts([10, 5, 4.5, .5]), 'expect 20');
        self::assertEquals(20, $calculator->addDiscounts(['10', 5, 4.5, .5]), 'expect 20');
    }

    public function testVariableDiscountMax(): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals(20, $calculator->getMaxVariable([20, '10', 16, 2.5, 19.9, -25]), 'expect 20');
    }


}