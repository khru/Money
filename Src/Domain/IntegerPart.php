<?php
/**
 * Created by PhpStorm.
 * User: sikay
 * Date: 13/07/2019
 * Time: 14:00
 */
declare(strict_types=1);

namespace WeDev\Price\Domain;


class integerPart extends Numerable implements IntegerPartInterface
{
    private $integerPart;

    private const DEFAULT_POSITIVE_NUMERIC_VALUE = '0';
    private const NEGATIVE_SIGN = '-';
    private const START_WITH_ZERO_NOT_ALLOWED_MGS = 'Leading zeros are not allowed';
    private const INVALID_INTEGER_PART_MGS = 'Invalid integer part %1$s. Invalid digit %2$s found';

    private function __construct(string $integerPart)
    {
        $this->setIntegerPart($integerPart);
    }

    public static function fromString(string $integerPart)
    {
        return new self($integerPart);
    }

    private function setIntegerPart(string $integerPart)
    {
        $this->integerPart = $this->parseIntegerPart($integerPart);
    }

    private function parseIntegerPart(string $integerPart): string
    {
        $defaultIntegerValue = $this->defaultValuesForIntegerValidation($integerPart);
        if (null !== $defaultIntegerValue) {
            return $defaultIntegerValue;
        }

        $this->validateIntegerPart($integerPart);

        return $integerPart;
    }

    private function defaultValuesForIntegerValidation(string $integerPart): ?string
    {
        if (self::EMPTY_STRING === $integerPart || self::DEFAULT_POSITIVE_NUMERIC_VALUE === $integerPart) {
            return self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        if (self::NEGATIVE_SIGN === $integerPart) {
            return self::NEGATIVE_SIGN . self::DEFAULT_POSITIVE_NUMERIC_VALUE;
        }

        return null;
    }

    private function validateIntegerPart(string $integerPart): void
    {
        $nonZero = false;
        $characters = strlen($integerPart);
        for ($position = 0; $position < $characters; ++$position) {
            $digit = $integerPart[$position];

            if (!isset(self::VALID_NUMBERS[$digit]) && !(0 === $position && self::NEGATIVE_SIGN === $digit)) {
                throw new \InvalidArgumentException(
                    sprintf(self::INVALID_INTEGER_PART_MGS, $integerPart, $digit)
                );
            }

            if (false === $nonZero && '0' === $digit) {
                throw new \InvalidArgumentException(self::START_WITH_ZERO_NOT_ALLOWED_MGS);
            }

            $nonZero = true;
        }
    }

    public function __invoke(): string
    {
        $this->getIntegerPart();
    }

    public function __toString(): string
    {
        return $this->integerPart;
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function equals (IntegerPartInterface $integerPart): bool
    {
        return $this->getIntegerPart() === $integerPart->getIntegerPart();
    }
}