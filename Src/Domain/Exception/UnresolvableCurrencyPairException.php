<?php

namespace WeDev\Price\Domain\Exception;

use WeDev\Price\Domain\Currency;

final class UnresolvableCurrencyPairException extends \InvalidArgumentException
{
    public static function createFromCurrencies(Currency $baseCurrency, Currency $counterCurrency): self
    {
        $message = sprintf(
            'Cannot resolve a currency pair for currencies: %s/%s',
            $baseCurrency->getCode(),
            $counterCurrency->getCode()
        );

        return new self($message);
    }
}
