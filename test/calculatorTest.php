<?php
declare(strict_types=1);

namespace test;
require_once("./vendor/autoload.php");

use Models\Discount;
use Models\DiscountCalculator;
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
            [600, 1000, Discount::newFixedDiscount(4), 'expect 600'],
            [000, 1000, Discount::newFixedDiscount(12), 'expect 0'],
            [2000, 20000, Discount::newVariableDiscount(90), 'expect 2000'],
            [000, 20000, Discount::newVariableDiscount(110), 'expect 0'],
            [1000, 1000, Discount::newFixedDiscount(-2), 'expect 1000']
        ];
    }

    /**
     * @dataProvider  provideCalcTestData
     * @param float $expectedResult
     * @param int $price
     * @param Discount $discount
     * @param string $expectMsg
     */
    public function testDiscountCalculator(float $expectedResult, int $price, Discount $discount, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculate($price, $discount), $expectMsg);
    }

    public function provideGroupDiscountTestData(): array
    {
        return [
            //testcase 1
            [
                Discount::newVariableDiscount(20),
                2000,
                [
                    Discount::newVariableDiscount(20)
                ],
                'expect 20, VARIABLE'],

            //testcase 2
            [
                Discount::newFixedDiscount(10),
                2000,
                [
                    Discount::newFixedDiscount(10)
                ],
                'expect 10, FIXED'],

            //testcase 3
            [
                Discount::newVariableDiscount(20),
                10000,
                [
                    Discount::newFixedDiscount(10),
                    Discount::newVariableDiscount(20)
                ],
                'expect 20, VARIABLE'],
            //testcase 4
            [
                Discount::newVariableDiscount(20),
                10000,
                [
                    Discount::newFixedDiscount(10),
                    Discount::newVariableDiscount(20)
                ],
                'expect 20, VARIABLE'],
            //testcase 5
            [
                Discount::newFixedDiscount(20),
                100,
                [
                    Discount::newFixedDiscount(10),
                    Discount::newFixedDiscount(5),
                    Discount::newFixedDiscount(5),
                    Discount::newVariableDiscount(18),
                    Discount::newVariableDiscount(12),
                    Discount::newVariableDiscount(10)
                ],
                'expect 20, FIXED'],
            //testcase 6
            [
                Discount::newVariableDiscount(18),
                10000,
                [
                    Discount::newFixedDiscount(10),
                    Discount::newFixedDiscount((int)null),
                    Discount::newFixedDiscount(5),
                    Discount::newVariableDiscount(18),
                    Discount::newVariableDiscount((int)null),
                    Discount::newVariableDiscount(10)
                ],
                'expect 20, FIXED'],            //testcase 6
//            [new Discount(15, Discount::FIXED),
//                (int)null,
//                [
//                    new Discount(10, Discount::FIXED),
//                    new Discount((int)null, Discount::FIXED),
//                    new Discount(5, Discount::FIXED),
//                    new Discount(18, Discount::VARIABLE),
//                    new Discount((int)null, Discount::VARIABLE),
//                    new Discount(10, Discount::VARIABLE)
//                ],
//                'expect 15, FIXED'],




//            [new Discount(10, Discount::FIXED), 20, 10, 25, 'expect 10, FIXED'],     //assuming that the function will pick the discount which gives the most value to the customer / gives the lowest end result
//            [[10, DiscountCalculator::VARIABLE], 20, 2, 50, 'expect 10, VARIABLE'],
//            [[15, DiscountCalculator::VARIABLE], 20, 2, 25, 'expect 15, VARIABLE'],
//            [[10, DiscountCalculator::FIXED], 20, 10, 50, 'expect 10, FIXED'],
//            [[0, DiscountCalculator::FIXED], -20, 10, 25, 'expect 0, FIXED'],
//            [[0, DiscountCalculator::VARIABLE], 20, -10, 120, 'expect 0, FIXED']
        ];
    }

    /**
     * @dataProvider  provideGroupDiscountTestData
     * @param Discount $expectedResult
     * @param int $price
     * @param Discount[] $discounts
     * @param string $expectMsg
     */
    public function testGroupDiscount(Discount $expectedResult, int $price, array $discounts, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculateGroupDiscount($price, $discounts), $expectMsg);
    }

    public function provideFullDiscountTestData(): array
    {
        return [
            [
                5.00,
                2000,
                Discount::newFixedDiscount(5),
                Discount::newFixedDiscount(10),
                'expect 500'
            ],

//            [15, 40, 10, 'FIXED', 50, 'VARIABLE', 'expect 15'],
//            [0, 40, 40, 'FIXED', 100, 'VARIABLE', 'expect 0'],
//            [30, 40, 10, 'VARIABLE', 25, 'VARIABLE', 'expect 30'],
//            [40, 40, 0, 'VARIABLE', 0, 'VARIABLE', 'expect 40'],
////            [40,40,0, 'VARIABLE', 16, 'SMURF', 'expect error: you dun goofed'],
//            [27, 40, 25, 'VARIABLE', 4, 'FIXED', 'expect 27'],
//            [25.2, 40, 30, 'VARIABLE', 4, 'FIXED', 'expect 25.2'],

        ];
    }

    /**
     * @dataProvider provideFullDiscountTestData
     * @param float $expectedResult
     * @param int $price
     * @param Discount $groupDiscount
     * @param Discount $customerDiscount
     * @param string $expectMsg
     */
    public function testFullDiscountCalculation(float $expectedResult, int $price, Discount $groupDiscount,Discount $customerDiscount, string $expectMsg): void
    {
        $calculator = new DiscountCalculator;
        self::assertEquals($expectedResult, $calculator->calculateCustomerDiscount($price, $groupDiscount, $customerDiscount), $expectMsg);
    }

//    public function testDiscountCalculatorException(float $expectedResult, int $price, int $discount, string $type, string $expectedMsg) : void
//    {
//
//        $calculator = new DiscountCalculator;
//        self::expectException($calculator->calculate($price, $discount, $type));
//    }

//    public function testFixedDiscountSum(): void
//    {
//        $calculator = new DiscountCalculator;
//        self::assertEquals(20, $calculator->addDiscounts([10, 5, 4.5, .5]), 'expect 20');
//        self::assertEquals(20, $calculator->addDiscounts(['10', 5, 4.5, .5]), 'expect 20');
//    }
//
//    public function testVariableDiscountMax(): void
//    {
//        $calculator = new DiscountCalculator;
//        self::assertEquals(20, $calculator->getMaxVariable([20, '10', 16, 2.5, 19.9, -25]), 'expect 20');
//    }

}