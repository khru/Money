<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Number;

class NumberTest extends TestCase
{
    private const A_POSITIVE_DECIMAL_NUMBER = 1.5;
    private const A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF = 1.56;
    private const A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF = 1.49;
    private const A_NEGATIVE_DECIMAL_NUMBER = -1.5;
    private const A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF = -1.56;
    private const A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF = -1.49;
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER = 0.5;
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER = -0.5;
    private const A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS = 1.500000;
    private const A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS = -1.500000;
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS = 0.50000;
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS = -0.50000;
    private const A_POSITIVE_INTEGER = 1;
    private const A_NEGATIVE_INTEGER = -1;
    private const A_POSITIVE_DECIMAL_NUMBER_STRING = '1.5';
    private const A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING = '1.56';
    private const A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING = '1.49';
    private const A_NEGATIVE_DECIMAL_NUMBER_STRING = '-1.5';
    private const A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING = '-1.56';
    private const A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING = '-1.49';
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING = '0.5';
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING = '-0.5';
    private const A_POSITIVE_INTEGER_STRING = '1';
    private const A_NEGATIVE_INTEGER_STRING = '-1';
    private const A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '1.500000';
    private const A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '-1.500000';
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '0.50000';
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '-0.50000';
    private const EMPTY_STRING = '';
    private const EMPTY_STRING_WITH_SPACES = '          ';
    private const A_BAD_FORMATTED_NUMBER_ARRAY = '1,56543.1';
    private const AN_OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_POINTS_STRING = '1.56543.1';
    private const OTHER_BAD_FORMATTED_NUMBER_STRING = '1.56543,1';
    private const OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_COMMAS_STRING = '1,56543,1';

    private const EMPTY_ARRAY = [];

    //**************************
    // Number preconditions
    // *************************

    /**
     * @test
     */
    public function typeErrorForNamedConstructorFloat()
    {
        $this->expectException(\TypeError::class);
        Number::fromFloat(null);
    }

    /**
     * @test
     */
    public function typeErrorForNamedConstructorString()
    {
        $this->expectException(\TypeError::class);
        Number::fromString(null);
    }

    /**
     * @test
     */
    public function typeErrorForNamedConstructorNumber()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromNumber(null);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnEmptyString()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::EMPTY_STRING);
    }

    /**
     * @test
     */
    public function shouldThrowTypeErrorOnEmptyArray()
    {
        $this->expectException(\TypeError::class);
        Number::fromString(self::EMPTY_ARRAY);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnFromBadFormattedNumberString()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::A_BAD_FORMATTED_NUMBER_ARRAY);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithTwoPoints()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::AN_OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_POINTS_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithPointAndComma()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::OTHER_BAD_FORMATTED_NUMBER_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithTwoCommas()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_COMMAS_STRING);
    }

    //**************************
    // Number from string
    // *************************

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnEmptyStringWithSpaces()
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::fromString(self::EMPTY_STRING_WITH_SPACES);
    }

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

    /**
     * @test
     */
    public function shouldCompareTwoStringFloatsAsEquals()
    {
        $number_a = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $number_b = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
    }

    /**
     * @test
     */
    public function shouldCompareTowStringFloatOneWithTailingZerosAsEquals()
    {
        $number_a = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
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

    /**
     * @test
     */
    public function shouldCompareTwoFloatAsEquals()
    {
        $number_a = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
    }

    /**
     * @test
     */
    public function shouldCompareTwoFloatOneWithTailingZerosAsEquals()
    {
        $number_a = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS);
        $number_b = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
    }

    //**************************
    // Number functions
    // *************************

    /**
     * @test
     */
    public function shouldBeEqualsComparingTwoEqualAndPositiveFloats()
    {
        $number_a = Number::fromFloat(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertFalse($number_a->equal($number_b));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualsComparingTwoDifferentAndPositiveFloats()
    {
        $number_a = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromFloat(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equal($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualsComparingTwoEqualAndPositiveFloatsWithNumberConstructor()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equal($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualsComparingTwoEqualFloatsWithStringConstructor()
    {
        $number_a = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $number_b = Number::fromString(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equal($number_b));
    }

    /**
     * @test
     */
    public function xxx()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equal($number_b));
    }
}
