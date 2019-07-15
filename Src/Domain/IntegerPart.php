<?php
/**
 * Created by PhpStorm.
 * User: sikay
 * Date: 13/07/2019
 * Time: 14:00
 */
declare(strict_types=1);

namespace WeDev\Price\Domain;


class integerPart extends Numerable
{
    private $integerPart;

    private const DEFAULT_POSITIVE_NUMERIC_VALUE = '0';
    private const NEGATIVE_SIGN = '-';

    public function __construct(string $integerPart)
    {
        $this->setIntegerPart($integerPart);
    }

    private function setIntegerPart(string $integerPart)
    {
        $this->integerPart = $this->parseIntegerPart($integerPart);
    }

    private function parseIntegerPart(string $integer): string
    {
        $default = $this->defaultValuesForIntegerValidation($integer);
        if (null !== $default) {
            return $default;
        }

        $this->checkNumber($integer);

        return $integer;
    }

    private function defaultValuesForIntegerValidation(string $integer): ?string
    {
        if (self::EMPTY_STRING === $integer || self::DEFAULT_POSITIVE_NUMERIC_VALUE === $integer) {
            return self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        if (self::NEGATIVE_SIGN === $integer) {
            return self::NEGATIVE_SIGN . self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        return null;
    }

    private function checkNumber(string $integer): void
    {
        $nonZero = false;
        $characters = strlen($integer);
        for ($position = 0; $position < $characters; ++$position) {
            $digit = $integer[$position];

            if (!isset(self::VALID_NUMBERS[$digit]) && !(0 === $position && self::NEGATIVE_SIGN === $digit)) {
                throw new \InvalidArgumentException(
                    sprintf('Invalid integer part %1$s. Invalid digit %2$s found', $integer, $digit)
                );
            }

            if (false === $nonZero && '0' === $digit) {
                throw new \InvalidArgumentException(
                    'Leading zeros are not allowed'
                );
            }

            $nonZero = true;
        }
    }

    public function isNegative(): bool
    {
        return self::NEGATIVE_SIGN === $this->integerPart[0];
    }

    public function __invoke(): string
    {
        $this->getIntegerPart();
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function equals (self $integerPart): bool
    {
        return $this->getIntegerPart() === $integerPart->getIntegerPart();
    }
}