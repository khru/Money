<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

interface DecimalInterface
{
    public function getDecimals(): string;

    public function equals(DecimalInterface $decimalPart): bool;
}
