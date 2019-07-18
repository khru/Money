<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

use WeDev\Price\Domain\Exception\IntegerInvalidArgument;

class Integer implements IntegerInterface
{
    private $integer;

    private const EMPTY_STRING = '';
    private const START_WITH_ZERO_NOT_ALLOWED_MGS = 'Leading zeros are not allowed';
    private const INVALID_INTEGER_PART_MGS = 'Invalid integer part %1$s';
    private const EMPTY_STRING_MGS = 'Integer part can not be empty';
    private const VALIDATOR_REGEX = '/^[-+]?[\d]+$/';
    private const LEADING_ZERO_VALIDATOR_REGEX = '/^[-+]?[0]+/';

    private function __construct(string $integer)
    {
        $this->setInteger($integer);
    }

    public static function fromString(string $integer)
    {
        return new self($integer);
    }

    private function setInteger(string $integer)
    {
        $this->validateInteger($integer);
        $this->integer = $integer;
    }

    private function validateInteger(string $integer)
    {
        if (self::EMPTY_STRING === $integer) {
            throw new IntegerInvalidArgument(
                sprintf(self::EMPTY_STRING_MGS, $integer)
            );
        }

        $this->validValueForAInteger($integer);
    }

    private function validValueForAInteger($integer)
    {
        if (!preg_match(self::VALIDATOR_REGEX, $integer)) {
            throw new IntegerInvalidArgument(
                sprintf(self::INVALID_INTEGER_PART_MGS, $integer)
            );
        }
        if (preg_match(self::LEADING_ZERO_VALIDATOR_REGEX, $integer)) {
            throw new IntegerInvalidArgument(
                sprintf(self::START_WITH_ZERO_NOT_ALLOWED_MGS, $integer)
            );
        }
    }

    public function __invoke(): string
    {
        return $this->getInteger();
    }

    public function __toString(): string
    {
        return $this->integer;
    }

    public function getInteger(): string
    {
        return $this->integer;
    }

    public function equals (IntegerInterface $integer): bool
    {
        return $this->getInteger() === $integer->getInteger();
    }
}