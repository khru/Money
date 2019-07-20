<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

use WeDev\Price\Domain\Exception\DecimalInvalidArgument;

class Decimal implements NumericPartInterface, DecimalInterface
{
    private const EMPTY_STRING = '';
    private const VALIDATOR_REGEX = '/^[\d]+$/m';

    private $decimal;

    private function __construct(string $decimal)
    {
        $this->setDecimal($decimal);
    }

    public static function fromString(string $decimal): self
    {
        return new self($decimal);
    }

    private function setDecimal(string $decimal): void
    {
        if (!$this->validateDecimal($decimal)) {
            throw new DecimalInvalidArgument(
                sprintf('Invalid decimal part %1$s. Is not numeric', $decimal)
            );
        }
        $this->decimal = $decimal;
    }

    public function __toString(): string
    {
        return $this->decimal;
    }

    public function getDecimals(): string
    {
        return $this->decimal;
    }

    public function equals(DecimalInterface $numericPart): bool
    {
        return $this->getDecimals() === $numericPart->getDecimals();
    }

    public function __invoke(): string
    {
        return $this->getDecimals();
    }

    private function validateDecimal(string $number): bool
    {
        if (self::EMPTY_STRING === $number) {
            return true;
        }
        $this->mustBeNumeric($number);

        return $this->validValueForADecimal($number);
    }

    private function mustBeNumeric(string $number)
    {
        if (!is_numeric($number)) {
            throw new DecimalInvalidArgument(
                sprintf('Invalid decimal part %1$s. Is not numeric', $number)
            );
        }
    }

    private function validValueForADecimal($number): bool
    {
        try {
            $number = (string) $number;
        } catch (\Exception $e) {
            throw new DecimalInvalidArgument(
                sprintf('Invalid decimal part %1$s. Is not numeric', $number)
            );
        }

        return (bool) preg_match_all(self::VALIDATOR_REGEX, $number, $matches, PREG_SET_ORDER, 0);
    }
}
