<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Number;
use WeDev\Price\Domain\NumberFormatDecorator;

class NumberFormatDecoratorTest extends TestCase
{
    // Numbers to test
    private const A_POSITIVE_INT_WITH_HALF_DECIMAL = 5.5;
    private const A_POSITIVE_INT_WITH_MORE_THAN_HALF_DECIMAL = 10.8;
    private const A_POSITIVE_INT_WITH_LESS_THAN_HALF_DECIMAL = 3.4;
    private const A_NEGATIVE_INT_WITH_HALF_DECIMAL = -5.5;
    private const A_NEGATIVEE_INT_WITH_MORE_THAN_HALF_DECIMAL = -10.8;
    private const A_NEGATIVE_INT_WITH_LESS_THAN_HALF_DECIMAL = -3.4;

    // Different types of friendly rounding
    private const A_HALF_POSITIVE_ROUNDING = 0.05;
    private const A_HALF_NEGATIVE_ROUNDING = -0.05;
    private const LESS_THAN_HALF_POSITIVE_ROUNDING = 0.05;
    private const LESS_THAN_HALF_NEGATIVE_ROUNDING = -0.05;

    /**
     * @test
     */
    public function xxx()
    {
        $num = Number::fromNumber(self::A_POSITIVE_INT_WITH_HALF_DECIMAL);
        $round = Number::fromNumber(self::A_HALF_POSITIVE_ROUNDING);
        $num_format = new NumberFormatDecorator($num);
        $num_rounded = $num_format->roundedNumber($round);
        $this->assertTrue($num_rounded->equal($num));
    }

    /**
     * @test
     */
    public function xxx1()
    {
        $num = Number::fromNumber(self::A_NEGATIVE_INT_WITH_HALF_DECIMAL);
        $round = Number::fromNumber(self::A_HALF_POSITIVE_ROUNDING);
        $num_format = new NumberFormatDecorator($num);
        dump($num_format->roundedNumber($round));
    }
}
