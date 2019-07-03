<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Number;

class NumberTest extends TestCase
{
    private const A_POSITIVE_DECIMAL_NUMBER = 1.5;
    private const A_NEGATIVE_DECIMAL_NUMBER = -1.5;
    private const A_POSITIVE_INTEGER = 1;
    //private const A_

    /**
     * @test
     */
    public function shouldCreateNumberFromString()
    {
        $number = Number::fromString("1.5");
        $this->assertTrue("1.5" === $number->__toString());
    }
}
