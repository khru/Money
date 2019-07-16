<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Decimal;
use WeDev\Price\Domain\Exception\DecimalInvalidArgument;

class DecimalTest extends TestCase
{
    private const A_BAD_FORMATTED_DECIMAL = '-5151';
    private const AN_OTHER_BAD_FORMATTED_DECIMAL = '-51.51';
    private const AN_OTHER_BAD_FORMATTED_DECIMAL_2 = '-5,1.51';
    private const A_WELL_FORMATTED_DECIMAL = '5151';
    private const AN_OTHER_BAD_FORMATTED_DECIMAL_3 = '51.51';
    private const AN_OTHER_BAD_FORMATTED_DECIMAL_4 = '5,1.51';
    private const A_RANDOM_STRING = 'sdlk,jgfhjhskdhgfkjshdhgkhkjhsdkjfhsdkjh';

    /**
     * @test
     */
    public function shouldNotCreateADecimalFromBadFormattedDecimal(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::A_BAD_FORMATTED_DECIMAL);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnOtherDecimalFromBadFormattedDecimal(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::AN_OTHER_BAD_FORMATTED_DECIMAL);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnOtherDecimalTwoFromBadFormattedDecimal(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::AN_OTHER_BAD_FORMATTED_DECIMAL_2);
    }

    /**
     * @test
     */
    public function shouldCreateAWellFormattedDecimal(): void
    {
        $decimal = Decimal::fromString(self::A_WELL_FORMATTED_DECIMAL);
        $this->assertTrue(self::A_WELL_FORMATTED_DECIMAL === $decimal->getDecimals());
    }

    /**
     * @test
     */
    public function shouldBeEqual(): void
    {
        $a_decimal = Decimal::fromString(self::A_WELL_FORMATTED_DECIMAL);
        $an_other_decimal = Decimal::fromString(self::A_WELL_FORMATTED_DECIMAL);
        $this->assertTrue($an_other_decimal->equals($a_decimal));
    }

    /**
     * @test
     */
    public function shouldNotCreateAnOtherDecimalFourFromBadFormattedDecimal(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::AN_OTHER_BAD_FORMATTED_DECIMAL_4);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnOtherDecimalTheeFromBadFormattedDecimal(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::AN_OTHER_BAD_FORMATTED_DECIMAL_3);
    }

    /**
     * @test
     */
    public function shouldNotCreatDecimalFromAString(): void
    {
        $this->expectException(DecimalInvalidArgument::class);
        Decimal::fromString(self::A_RANDOM_STRING);
    }
}
