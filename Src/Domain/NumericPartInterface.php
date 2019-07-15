<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

interface NumericPartInterface
{
    public function __toString(): string;

    public function __invoke(): int;
}
