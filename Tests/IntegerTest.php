<?php
/**
 * Created by PhpStorm.
 * User: sikay
 * Date: 17/07/2019
 * Time: 18:33
 */

namespace WeDev\Price\Tests;

use PHPUnit\Framework\TestCase;
use WeDev\Price\Domain\Integer;
use WeDev\Price\Domain\Exception\IntegerInvalidArgument;

class IntegerTest extends TestCase
{
    private const AN_EMPTY_STRING = '';
    private const A_RANDOM_STRING = 'VYOkgvUIOUVyLVtL';
    private const A_BAD_FORMATTED_INTEGER = '89.21';
    private const A_BAD_FORMATTED_NEGATIVE_INTEGER = '-89.21';
    private const A_BAD_FORMATTED_POSITIVE_INTEGER = '+89.21';
    private const A_BAD_FORMATTED_INTEGER_WITH_SIGN = '~89.21';
    private const A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS = '0004729';
    private const A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS_2 = '000573.69';
    private const A_BAD_FORMATTED_NEGATIVE_INTEGER_WITH_LEADING_ZEROS = '-0004729';
    private const A_BAD_FORMATTED_NEGATIVE_INTEGER_WITH_LEADING_ZEROS_2 = '-000573.69';
    private const A_BAD_FORMATTED_POSITIVE_INTEGER_WITH_LEADING_ZEROS = '+0004729';
    private const A_BAD_FORMATTED_POSITIVE_INTEGER_WITH_LEADING_ZEROS_2 = '+000573.69';
    private const A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS_AND_SIGN = '~0004729';
    private const A_WELL_FORMATTED_REAL_INTEGER = 3847;
    private const A_WELL_FORMATTED_STRING_INTEGER = '4762';



    //**************************
    // Integer
    // *************************

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromAnEmptyString()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::AN_EMPTY_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromARandomString()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_RANDOM_STRING);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedInteger()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_INTEGER);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedNegativeInteger()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_NEGATIVE_INTEGER);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedPosiiveInteger()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_POSITIVE_INTEGER);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedIntegerWithSign()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_INTEGER_WITH_SIGN);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedIntegerWithLeadingZeros()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedIntegerWithLeadingZeros2()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS_2);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedNegativeIntegerWithLeadingZeros()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_NEGATIVE_INTEGER_WITH_LEADING_ZEROS);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedNegativeIntegerWithLeadingZeros2()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_NEGATIVE_INTEGER_WITH_LEADING_ZEROS_2);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedPositiveIntegerWithLeadingZeros()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_POSITIVE_INTEGER_WITH_LEADING_ZEROS);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedPositiveIntegerWithLeadingZeros2()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_POSITIVE_INTEGER_WITH_LEADING_ZEROS_2);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromABadFormattedIntegerWithLeadingZerosAndSign()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_BAD_FORMATTED_INTEGER_WITH_LEADING_ZEROS_AND_SIGN);
    }

    /**
     * @test
     */
    public function shouldNotCreateAnIntegerFromAWellFormattedRealInteger()
    {
        $this->expectException(IntegerInvalidArgument::class);
        Integer::fromString(self::A_WELL_FORMATTED_REAL_INTEGER);
    }
}
