<?php

namespace WeDev\Price\Domain;

final class Number
{
    private $integerPart;

    private $fractionalPart;

    private $numbers = [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1];

    private function __construct(string $integerPart, string $fractionalPart = '')
    {
        if ('' === $integerPart && '' === $fractionalPart) {
            throw new \InvalidArgumentException('Empty number is invalid');
        }

        $this->integerPart = $this->parseIntegerPart((string) $integerPart);
        $this->fractionalPart = $this->parseFractionalPart((string) $fractionalPart);
    }

    public static function fromString($number): self
    {
        $decimalSeparatorPosition = strpos($number, '.');
        if (false === $decimalSeparatorPosition) {
            return new self($number, '');
        }

        return new self(
            substr($number, 0, $decimalSeparatorPosition),
            rtrim(substr($number, $decimalSeparatorPosition + 1), '0')
        );
    }

    public static function fromFloat(float $number): self
    {
        if (false === is_float($number)) {
            throw new \InvalidArgumentException('Floating point value expected');
        }

        return self::fromString(sprintf('%.14F', $number));
    }

    /**
     * @param float|int|string $number
     *
     * @return self
     */
    public static function fromNumber($number): self
    {
        if (is_float($number)) {
            return self::fromString(sprintf('%.14F', $number));
        }

        if (is_int($number)) {
            return new self($number);
        }

        if (is_string($number)) {
            return self::fromString($number);
        }

        throw new \InvalidArgumentException('Valid numeric value expected');
    }

    public function isDecimal(): bool
    {
        return '' !== $this->fractionalPart;
    }

    public function isInteger(): bool
    {
        return '' === $this->fractionalPart;
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
        if ('' === $this->fractionalPart) {
            return false;
        }

        return $this->fractionalPart[0] >= 5;
    }

    public function __toString(): string
    {
        if ('' === $this->fractionalPart) {
            return $this->integerPart;
        }

        return $this->integerPart . '.' . $this->fractionalPart;
    }

    public function toFloat(): float
    {
        return (float) ('' !== $this->fractionalPart) ?
            $this->integerPart . $this->fractionalPart :
            $this->integerPart;
    }

    public function isNegative(): bool
    {
        return '-' === $this->integerPart[0];
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function getFractionalPart(): string
    {
        return $this->fractionalPart;
    }

    public function base10(int $number): self
    {
        if ('0' === $this->integerPart && !$this->fractionalPart) {
            return $this;
        }

        $sign = '';
        $integerPart = $this->integerPart;

        if ('-' === $integerPart[0]) {
            $sign = '-';
            $integerPart = substr($integerPart, 1);
        }

        if ($number >= 0) {
            $integerPart = ltrim($integerPart, '0');
            $lengthIntegerPart = strlen($integerPart);
            $integers = $lengthIntegerPart - min($number, $lengthIntegerPart);
            $zeroPad = $number - min($number, $lengthIntegerPart);

            return new self(
                $sign . substr($integerPart, 0, $integers),
                rtrim(str_pad('', $zeroPad, '0') . substr($integerPart, $integers) . $this->fractionalPart, '0')
            );
        }

        $number = abs($number);
        $lengthFractionalPart = strlen($this->fractionalPart);
        $fractions = $lengthFractionalPart - min($number, $lengthFractionalPart);
        $zeroPad = $number - min($number, $lengthFractionalPart);

        return new self(
            $sign . ltrim($integerPart .
                substr($this->fractionalPart, 0, $lengthFractionalPart - $fractions) .
                str_pad('', $zeroPad, '0'), '0'),
            substr($this->fractionalPart, $lengthFractionalPart - $fractions)
        );
    }

    private function parseIntegerPart(string $number): string
    {
        if ('' === $number || '0' === $number) {
            return '0';
        }

        if ('-' === $number) {
            return '-0';
        }

        $nonZero = false;
        $characters = strlen($number);
        for ($position = 0; $position < $characters; ++$position) {
            $digit = $number[$position];

            if (!isset($this->numbers[$digit]) && !(0 === $position && '-' === $digit)) {
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

    private function parseFractionalPart(string $number): string
    {
        if ('' === $number) {
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
}
