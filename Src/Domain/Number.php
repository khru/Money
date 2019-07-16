<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

final class Number
{
    private $integerPart;
    private $decimals;

    private const EMPTY_STRING = '';
    private const FLOAT_FORMAT = '%.14F';
    private const NEGATIVE_SIGN = '-';
    private const NUMERIC_SEPARATOR = '.';
    private const DEFAULT_POSITIVE_NUMERIC_VALUE = '0';
    private const FIRST_CHART = '0';
    private const HALF_DECIMAL_VALUE = '5';
    private const VALIDATOR_REGEX = '/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/m';
    private const VALID_NUMBER_MSG = 'Valid numeric value expected';

    private const VALID_NUMBERS = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    private function __construct(string $integerPart, string $decimals = '')
    {
        $this->notNullArguments($integerPart, $decimals);

        $this->integerPart = $this->parseIntegerPart($integerPart);
        $this->decimals = Decimal::fromString($decimals)->__toString();
    }

    private static function fromString(string $number): self
    {
        if (!static::validNumber($number)) {
            throw new \InvalidArgumentException(self::VALID_NUMBER_MSG);
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

        throw new \InvalidArgumentException(self::VALID_NUMBER_MSG);
    }

    public function __invoke(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        if (self::EMPTY_STRING === $this->decimals) {
            return $this->integerPart;
        }

        return $this->integerPart . self::NUMERIC_SEPARATOR . $this->decimals;
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
        $lastIntegerPartNumber = $this->integerPart[strlen($this->integerPart) - 1];

        return 0 === $lastIntegerPartNumber % 2;
    }

    public function isCloserToNext(): bool
    {
        if (self::EMPTY_STRING === $this->getDecimals()) {
            return false;
        }

        return $this->getDecimals()[0] >= 5;
    }

    public function toFloat(): float
    {
        return  (self::EMPTY_STRING !== $this->getDecimals()) ?
            (float) ($this->integerPart . self::NUMERIC_SEPARATOR . $this->getDecimals()) :
            (float) $this->integerPart;
    }

    public function isNegative(): bool
    {
        return self::NEGATIVE_SIGN === $this->integerPart[0];
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function getDecimals(): string
    {
        return $this->decimals;
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

            if (!isset(self::VALID_NUMBERS[$digit]) && !(0 === $position && self::NEGATIVE_SIGN === $digit)) {
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

    public function equals(self $number): bool
    {
        return $this->integerPart === $number->getIntegerPart() &&
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
            throw new \InvalidArgumentException('An empty number is invalid');
        }
    }
}
