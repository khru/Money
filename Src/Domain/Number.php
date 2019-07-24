<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

use WeDev\Price\Domain\Exception\NumberInvalidArgument;

final class Number
{
    private $integer;
    private $decimals;

    private const EMPTY_STRING = '';
    private const FLOAT_FORMAT = '%.14F';
    private const NEGATIVE_SIGN = '-';
    private const NUMERIC_SEPARATOR = '.';
    private const FIRST_CHART = '0';
    private const HALF_DECIMAL_VALUE = '5';
    private const VALIDATOR_REGEX = '/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/m';
    private const VALID_NUMBER_MSG = 'Valid numeric value expected';

    private function __construct(string $integer, string $decimals = '')
    {
        $this->notNullArguments($integer, $decimals);

        $this->integer = Integer::fromString($integer);
        $this->decimals = Decimal::fromString($decimals);
    }

    private static function fromString(string $number): self
    {
        if (!static::validNumber($number)) {
            throw new NumberInvalidArgument(self::VALID_NUMBER_MSG);
        }

        $decimalSeparatorPosition = strpos($number, self::NUMERIC_SEPARATOR);
        if (false === $decimalSeparatorPosition) {
            return new self($number, self::EMPTY_STRING);
        }

        return new self(
            substr($number, 0, $decimalSeparatorPosition),
            rtrim(substr($number, $decimalSeparatorPosition + 1), self::FIRST_CHART)
        );
    }

    /**
     * @param float|int|string $number
     *
     * @return self
     */
    public static function fromNumber($number): self
    {
        if (is_float($number)) {
            return self::fromString(sprintf(self::FLOAT_FORMAT, $number));
        }

        if (is_int($number)) {
            return new self((string) $number);
        }

        if (is_string($number)) {
            return self::fromString($number);
        }

        throw new NumberInvalidArgument(self::VALID_NUMBER_MSG);
    }

    public function __invoke(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        if (self::EMPTY_STRING === $this->getDecimals()) {
            return $this->getInteger();
        }

        return $this->integer . self::NUMERIC_SEPARATOR . $this->getDecimals();
    }

    public function isDecimal(): bool
    {
        return self::EMPTY_STRING !== $this->decimals;
    }

    public function isInteger(): bool
    {
        return self::EMPTY_STRING === $this->decimals;
    }

    public function isHalf(): bool
    {
        return self::HALF_DECIMAL_VALUE === $this->getDecimals();
    }

    public function isCurrentEven(): bool
    {
        $lastIntegerNumber = $this->integer[strlen($this->integer) - 1];

        return 0 === $lastIntegerNumber % 2;
    }

    public function isCloserToNext(): bool
    {
        if (self::EMPTY_STRING === $this->getDecimals()) {
            return false;
        }

        return (int) $this->getDecimals()[0] >= 5;
    }

    public function toFloat(): float
    {
        return  (self::EMPTY_STRING !== $this->getDecimals()) ?
            (float) ($this->integer . self::NUMERIC_SEPARATOR . $this->getDecimals()) :
            (float) $this->integer;
    }

    public function isNegative(): bool
    {
        return self::NEGATIVE_SIGN === $this->integer[0];
    }

    public function getInteger(): string
    {
        return $this->integer->__toString();
    }

    public function getDecimals(): string
    {
        return $this->decimals->__toString();
    }

    public function equals(self $number): bool
    {
        return $this->getInteger() === $number->getInteger() &&
            $this->getDecimals() === $number->getDecimals();
    }

    private function validNumber($number): bool
    {
        try {
            $number = (string) $number;
        } catch (\Exception $e) {
            return false;
        }

        return (bool) preg_match_all(self::VALIDATOR_REGEX, $number, $matches, PREG_SET_ORDER, 0);
    }

    private function notNullArguments(string $integerPart, string $fractionalPart)
    {
        if (self::EMPTY_STRING === $integerPart && self::EMPTY_STRING === $fractionalPart) {
            throw new NumberInvalidArgument('An empty number is invalid');
        }
    }
}
