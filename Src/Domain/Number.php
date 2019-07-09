<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

final class Number
{
    private $integerPart;

    private $fractionalPart;

    private const EMPTY_STRING = '';
    private const FLOAT_FORMAT = '%.14F';
    private const NEGATIVE_SIGN = '-';
    private const NUMERIC_SEPARATOR = '.';
    private const DEFAULT_POSITIVE_NUMERIC_VALUE = '0';
    private const FIRST_CHART = '0';

    private $numbers = [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1];

    private function __construct(string $integerPart, string $fractionalPart = '')
    {
        $this->preconditionNotNullArguments($integerPart, $fractionalPart);

        $this->integerPart = $this->parseIntegerPart((string) $integerPart);
        $this->fractionalPart = $this->parseFractionalPart((string) $fractionalPart);
    }

    public static function fromString(string $number): self
    {
        $decimalSeparatorPosition = strpos($number, self::NUMERIC_SEPARATOR);
        if (false === $decimalSeparatorPosition) {
            return new self($number, self::EMPTY_STRING);
        }

        return new self(
            substr($number, 0, $decimalSeparatorPosition),
            rtrim(substr($number, $decimalSeparatorPosition + 1), self::FIRST_CHART)
        );
    }

    public static function fromFloat(float $number): self
    {
        if (false === is_float($number)) {
            throw new \InvalidArgumentException('Floating point value expected');
        }

        return self::fromString(sprintf(self::FLOAT_FORMAT, $number));
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
            return new self($number);
        }

        if (is_string($number)) {
            return self::fromString($number);
        }

        throw new \InvalidArgumentException('Valid numeric value expected');
    }

    public function __invoke(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        if (self::EMPTY_STRING === $this->fractionalPart) {
            return $this->integerPart;
        }

        return $this->integerPart . self::NUMERIC_SEPARATOR . $this->fractionalPart;
    }

    public function isDecimal(): bool
    {
        return self::EMPTY_STRING !== $this->fractionalPart;
    }

    public function isInteger(): bool
    {
        return self::EMPTY_STRING === $this->fractionalPart;
    }

    public function isHalf(): bool
    {
        return '5' === $this->fractionalPart;
    }

    public function isCurrentEven(): bool
    {
        $lastIntegerPartNumber = $this->integerPart[strlen($this->integerPart) - 1];

        return 0 === $lastIntegerPartNumber % 2;
    }

    public function isCloserToNext(): bool
    {
        if (self::EMPTY_STRING === $this->fractionalPart) {
            return false;
        }

        return $this->fractionalPart[0] >= 5;
    }

    public function toFloat(): float
    {
        return (float) (self::EMPTY_STRING !== $this->fractionalPart) ?
            $this->integerPart . $this->fractionalPart :
            $this->integerPart;
    }

    public function isNegative(): bool
    {
        return self::NEGATIVE_SIGN === $this->integerPart[0];
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function getFractionalPart(): string
    {
        return $this->fractionalPart;
    }

    private function parseIntegerPart(string $number): string
    {
        $default = $this->defaultValuesForIntegerValidation($number);
        if (null !== $default) {
            return $default;
        }

        $nonZero = false;
        $characters = strlen($number);
        for ($position = 0; $position < $characters; ++$position) {
            $digit = $number[$position];

            if (!isset($this->numbers[$digit]) && !(0 === $position && self::NEGATIVE_SIGN === $digit)) {
                throw new \InvalidArgumentException(
                    sprintf('Invalid integer part %1$s. Invalid digit %2$s found', $number, $digit)
                );
            }

            if (false === $nonZero && '0' === $digit) {
                throw new \InvalidArgumentException(
                    'Leading zeros are not allowed'
                );
            }

            $nonZero = true;
        }

        return $number;
    }

    private function defaultValuesForIntegerValidation(string $number): ?string
    {
        if (self::EMPTY_STRING === $number || self::DEFAULT_POSITIVE_NUMERIC_VALUE === $number) {
            return self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        if (self::NEGATIVE_SIGN === $number) {
            return self::NEGATIVE_SIGN . self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        return null;
    }

    private function parseFractionalPart(string $number): string
    {
        if (self::EMPTY_STRING === $number) {
            return $number;
        }

        for ($position = 0, $characters = strlen($number); $position < $characters; ++$position) {
            $digit = $number[$position];
            if (!isset($this->numbers[$digit])) {
                throw new \InvalidArgumentException(
                    sprintf('Invalid fractional part %1$s. Invalid digit %2$s found', $number, $digit)
                );
            }
        }

        return $number;
    }

    public function equal(self $number): bool
    {
        return $this->integerPart === $number->getIntegerPart() &&
            $this->fractionalPart === $number->getFractionalPart();
    }

    private function preconditionNotNullArguments(string $integerPart, string $fractionalPart)
    {
        if (self::EMPTY_STRING === $integerPart && self::EMPTY_STRING === $fractionalPart) {
            throw new \InvalidArgumentException('Empty number is invalid');
        }
    }
}
