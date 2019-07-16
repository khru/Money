<?php

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Exception\NumberInvalidArgument;
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
    private const A_NEGATIVE_DECIMAL_NUMBER_STRING = '-1.5';
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING = '0.5';
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING = '-0.5';
    private const A_POSITIVE_INTEGER_STRING = '1';
    private const A_NEGATIVE_INTEGER_STRING = '-1';
    private const A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '1.500000';
    private const A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '-1.500000';
    private const EMPTY_STRING = '';
    private const EMPTY_STRING_WITH_SPACES = '          ';
    private const A_BAD_FORMATTED_NUMBER_ARRAY = '1,56543.1';
    private const AN_OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_POINTS_STRING = '1.56543.1';
    private const OTHER_BAD_FORMATTED_NUMBER_STRING = '1.56543,1';
    private const OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_COMMAS_STRING = '1,56543,1';
    private const EMPTY_ARRAY = [];
    private const AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '-0.50000';
    private const AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING = '0.50000';
    private const A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING = '-1.49';
    private const A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING = '-1.56';
    private const A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING = '1.49';
    private const A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING = '1.56';

    //**************************
    // Number preconditions
    // *************************

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentForNamedConstructorString()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(null);
    }

    /**
     * @test
     */
    public function typeErrorForNamedConstructorNumber()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(null);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnEmptyString()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::EMPTY_STRING);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentOnEmptyArray()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::EMPTY_ARRAY);
    }

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnFromBadFormattedNumberString()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::A_BAD_FORMATTED_NUMBER_ARRAY);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithTwoPoints()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::AN_OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_POINTS_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithPointAndComma()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::OTHER_BAD_FORMATTED_NUMBER_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateANumberFromAStringWithTwoCommas()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::OTHER_BAD_FORMATTED_NUMBER_WITH_TWO_COMMAS_STRING);
    }

    //**************************
    // Number from string
    // *************************

    /**
     * @test
     */
    public function shouldThrowInvalidArgumentExceptionOnEmptyStringWithSpaces()
    {
        $this->expectException(NumberInvalidArgument::class);
        Number::fromNumber(self::EMPTY_STRING_WITH_SPACES);
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalString()
    {
        $number = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalString()
    {
        $number = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::A_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalWithOnlyFractionalPartString()
    {
        $number = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalWithOnlyFractionalPartString()
    {
        $number = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveIntegerString()
    {
        $number = Number::fromNumber(self::A_POSITIVE_INTEGER_STRING);
        $this->assertTrue(self::A_POSITIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeIntegerString()
    {
        $number = Number::fromNumber(self::A_NEGATIVE_INTEGER_STRING);
        $this->assertTrue(self::A_NEGATIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldRemoveTailingZerosFromFloat()
    {
        $number = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCompareTwoStringFloatsAsEquals()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
    }

    /**
     * @test
     */
    public function shouldCompareTowStringFloatOneWithTailingZerosAsEquals()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
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
        $number = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === (string) $number);
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimal()
    {
        $number = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_POSITIVE_DECIMAL_NUMBER_STRING === (string) $number);
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimal()
    {
        $number = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::A_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveDecimalWithOnlyFractionalPart()
    {
        $number = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeDecimalWithOnlyFractionalPart()
    {
        $number = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromAPositiveInteger()
    {
        $number = Number::fromNumber(self::A_POSITIVE_INTEGER);
        $this->assertTrue(self::A_POSITIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCreateNumberFromANegativeInteger()
    {
        $number = Number::fromNumber(self::A_NEGATIVE_INTEGER);
        $this->assertTrue(self::A_NEGATIVE_INTEGER_STRING === $number->__toString());
    }

    /**
     * @test
     */
    public function shouldCompareTwoFloatAsEquals()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->toFloat() === $number_b->toFloat());
    }

    /**
     * @test
     */
    public function shouldCompareTwoFloatOneWithTailingZerosAsEquals()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
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
        $number_a = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertFalse($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualsComparingTwoDifferentAndPositiveFloats()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualsComparingTwoEqualAndPositiveFloatsWithNumberConstructor()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualsComparingTwoEqualFloatsWithStringConstructor()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoNumbersWithTailingZeros()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoNegativeNumbersUnderOneWithTailingZeros()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS);
        $number_b = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoNegativeNumbersUnderOneWithTailingZerosString()
    {
        $number_a = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoPositiveNumbersUnderOneWithTailingZerosString()
    {
        $number_a = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoPositiveNumbersUnderOneWithTailingZeros()
    {
        $number_a = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER_TAILING_ZEROS);
        $number_b = Number::fromNumber(self::AN_OTHER_POSITIVE_DECIMAL_NUMBER);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoNegativeNumbersWithTailingZeros()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS_STRING);
        $number_b = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldBeEqualTwoNegativeDecimalNumbersWithTailingZeros()
    {
        $number_a = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_TAILING_ZEROS);
        $number_b = Number::fromNumber(self::AN_OTHER_NEGATIVE_DECIMAL_NUMBER_STRING);
        $this->assertTrue($number_a->equals($number_b));
    }

    /**
     * @test
     */
    public function shouldNotBehalfByPositiveDecimalNumberBiggerThanHalf()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByPositiveDecimalNumberSmallerThanHalf()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByNegativeDecimalNumberSmallerThanHalf()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByNegativeDecimalNumberBiggerThanHalf()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByPositiveDecimalNumberBiggerThanHalfString()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByPositiveDecimalNumberSmallerThanHalfString()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByNegativeDecimalNumberSmallerThanHalfString()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldNotBehalfByNegativeDecimalNumberBiggerThanHalfString()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isHalf());
    }

    /**
     * @test
     */
    public function shouldBeCloseToNextNumberFloat()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF);
        $this->assertTrue($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldNotBeCloseToNextNumberFloat()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF);
        $this->assertFalse($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldNotBeCloseToNextNegativeNumberFloat()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF);
        $this->assertFalse($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldBeCloseToNextNegativeNumberFloat()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF);
        $this->assertTrue($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldBeCloseToNextNumberString()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING);
        $this->assertTrue($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldNotBeCloseToNextNumberString()
    {
        $number_a = Number::fromNumber(self::A_POSITIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldNotBeCloseToNextNegativeNumberString()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_SMALLER_THAN_HALF_STRING);
        $this->assertFalse($number_a->isCloserToNext());
    }

    /**
     * @test
     */
    public function shouldBeCloseToNextNegativeNumberString()
    {
        $number_a = Number::fromNumber(self::A_NEGATIVE_DECIMAL_NUMBER_BIGGER_THAN_HALF_STRING);
        $this->assertTrue($number_a->isCloserToNext());
    }
}
