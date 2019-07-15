<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

interface DecimalPartInterface
{
    public function getDecimals(): int;

    public function equals(DecimalPartInterface $decimalPart): bool;
}
