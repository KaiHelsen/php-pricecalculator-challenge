<?php
declare(strict_types=1);

namespace test;
require_once ("./vendor/autoload.php");

//use ComposerIncludeFiles\models\Calculator;
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
            [0, 10, 12, 'FIXED', 'expect 0']
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
    public function testBaseFunctionality(float $expectedResult, int $price, int $discount, string $type, string $expectMsg): void
    {
        $calculator = new Calculator;
        self::assertequals($expectedResult, $calculator->calculate($price, $discount, $type), $expectMsg);
    }


}