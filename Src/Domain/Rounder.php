<?php


namespace WeDev\Price\Domain;


class Rounder
{
    /**
     * @param string $moneyValue
     * @param int    $targetDigits
     * @param int    $havingDigits
     *
     * @return string
     */
    public static function roundMoneyValue(string $moneyValue, int $targetDigits, int $havingDigits)
    {
        $valueLength = strlen($moneyValue);
        $shouldRound = $targetDigits < $havingDigits && $valueLength - $havingDigits + $targetDigits > 0;

        if ($shouldRound && $moneyValue[$valueLength - $havingDigits + $targetDigits] >= 5) {
            $position = $valueLength - $havingDigits + $targetDigits;
            $addend = 1;

            while ($position > 0) {
                $newValue = (string) ((int) $moneyValue[$position - 1] + $addend);

                if ($newValue >= 10) {
                    $moneyValue[$position - 1] = $newValue[1];
                    $addend = $newValue[0];
                    --$position;
                    if (0 === $position) {
                        $moneyValue = $addend . $moneyValue;
                    }
                } else {
                    if ('-' === $moneyValue[$position - 1]) {
                        $moneyValue[$position - 1] = $newValue[0];
                        $moneyValue = '-' . $moneyValue;
                    } else {
                        $moneyValue[$position - 1] = $newValue[0];
                    }

                    break;
                }
            }
        }

        return $moneyValue;
    }
}
