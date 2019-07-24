<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

final class Number
{
    private $integer;

    private $fractionalPart;

    private const EMPTY_STRING = '';
    private const FLOAT_FORMAT = '%.14F';
    private const NEGATIVE_SIGN = '-';
    private const NUMERIC_SEPARATOR = '.';
    private const FIRST_CHART = '0';

    private const VALID_NUMBERS = [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1];

    private function __construct(string $integer, string $fractionalPart = '')
    {
        $this->preconditionNotNullArguments($integer, $fractionalPart);

        $this->integer = Integer::fromString((string) $integer)->__toString();
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
            return new self((string) $number);
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
            return $this->integer;
        }

        return $this->integer . self::NUMERIC_SEPARATOR . $this->fractionalPart;
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
        $lastIntegerNumber = $this->integer[strlen($this->integer) - 1];

        return 0 === $lastIntegerNumber % 2;
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
        return  (self::EMPTY_STRING !== $this->fractionalPart) ?
            (float) ($this->integer . self::NUMERIC_SEPARATOR . $this->fractionalPart) :
            (float) $this->integer;
    }

    public function isNegative(): bool
    {
        return self::NEGATIVE_SIGN === $this->integer[0];
    }

    public function getInteger(): string
    {
        return $this->integer;
    }

    public function getFractionalPart(): string
    {
        return $this->fractionalPart;
    }

    private function parseFractionalPart(string $number): string
    {
        if (self::EMPTY_STRING === $number) {
            return $number;
        }

        for ($position = 0, $characters = strlen($number); $position < $characters; ++$position) {
            $digit = $number[$position];
            if (!isset(self::VALID_NUMBERS[$digit])) {
                throw new \InvalidArgumentException(
                    sprintf('Invalid fractional part %1$s. Invalid digit %2$s found', $number, $digit)
                );
            }
        }

        return $number;
    }

    public function equal(self $number): bool
    {
        return $this->integer === $number->getInteger() &&
            $this->fractionalPart === $number->getFractionalPart();
    }

    private function preconditionNotNullArguments(string $integer, string $fractionalPart)
    {
        if (self::EMPTY_STRING === $integer && self::EMPTY_STRING === $fractionalPart) {
            throw new \InvalidArgumentException('Empty number is invalid');
        }
    }
}
