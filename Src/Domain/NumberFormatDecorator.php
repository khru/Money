<?php

declare(strict_types=1);

namespace WeDev\Price\Domain;

class NumberFormatDecorator
{
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    /**
     * @param float $round
     *
     * @return Number
     */
    public function roundedNumber(Number $round): Number
    {
        $round = $round->toFloat();
        $number = $this->number->toFloat();
        $mod = fmod($number, $round);
        $result = 0.0;

        if (!is_null($mod) && $mod === $result) {
            $result = $number;
        } else {
            $result = ($round - $mod) + $number;
        }

        if (!is_null($round) && !is_null($result) && strlen((string) $result) > strlen((string) $round)) {
            $result = $this->numberFormat($result, strlen(($this->number->getFractionalPart())));
        }

        return Number::fromFloat($result);
    }

    private function numberFormat(float $psp, $precision = 2): float
    {
        return (float) number_format($psp, $precision, '.', '');
    }

    private function numberFormatRounded(float $psp, $round = false, $precision = 2): float
    {
        return intval($psp * ($p = pow(10, $precision))) / $p;
    }
}
