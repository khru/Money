<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

use WeDev\Price\Currency;

interface Currencies extends \IteratorAggregate
{
    /**
     * Checks whether a currency is available in the current context.
     *
     * @param Currency $currency
     *
     * @return bool
     */
    public function contains(Currency $currency): bool;

    /**
     * Returns the subunit for a currency.
     *
     * @param Currency $currency
     *
     * @return int
     *
     * @throws UnknownCurrencyException If currency is not available in the current context
     */
    public function subunitFor(Currency $currency): int;
}
