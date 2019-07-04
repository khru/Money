<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Number;

class NumberTest extends TestCase
{
    private const A_POSITIVE_DECIMAL_NUMBER = 1.5;
    private const A_NEGATIVE_DECIMAL_NUMBER = -1.5;
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER = 0.5;
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER = -0.5;
    private const A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS = 1.500000;
    private const A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS = -1.500000;
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS = 0.50000;
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS = -0.50000;
    private const A_POSITIVE_INTEGER = 1;
    private const A_NEGATIVE_INTEGER = -1;
    private const A_POSITIVE_DECIMAL_NUMBER_STRING = '1.5';
    private const A_NEGATIVE_DECIMAL_NUMBER_STRING = '-1.5';
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING = '0.5';
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING = '-0.5';
    private const A_POSITIVE_INTEGER_STRING = '1';
    private const A_NEGATIVE_INTEGER_STRING = '-1';
    private const A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = "1.500000";
    private const A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = "-1.500000";
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = "0.50000";
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = "-0.50000";

    //**************************
    // Number from string
    // *************************

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalString()
    {
        $number = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalString()
    {
        $number = Number::fromString(self::A_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::A_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalWithOnlyFractionalPartString()
    {
        $number = Number::fromString(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalWithOnlyFractionalPartString()
    {
        $number = Number::fromString(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveIntegerString()
    {
        $number = Number::fromString(self::A_POSITIVE_INTEGER_STRING);
        $this->assertTrue(self::A_POSITIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeIntegerString()
    {
        $number = Number::fromString(self::A_NEGATIVE_INTEGER_STRING);
        $this->assertTrue(self::A_NEGATIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldRemoveTailingZerosFromFloat()
    {
        $number = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    //**************************
    // Number from float
    // *************************

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveFloat()
    {
        $number = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === (string) $number);
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimal()
    {
        $number = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === (string) $number);
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimal()
    {
        $number = Number::fromFloat(self::A_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalWithOnlyFractionalPart()
    {
        $number = Number::fromFloat(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalWithOnlyFractionalPart()
    {
        $number = Number::fromFloat(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveInteger()
    {
        $number = Number::fromFloat(self::A_POSITIVE_INTEGER);
        $this->assertTrue(self::A_POSITIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeInteger()
    {
        $number = Number::fromFloat(self::A_NEGATIVE_INTEGER);
        $this->assertTrue(self::A_NEGATIVE_INTEGER_STRING === $number->__toString());
    }
}
