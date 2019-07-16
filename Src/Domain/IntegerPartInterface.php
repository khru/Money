<?php
/**
 * Created by PhpStorm.
 * User: sikay
 * Date: 16/07/2019
 * Time: 17:25
 */

namespace WeDev\Price\Domain;


interface IntegerPartInterface
{
    public function getIntegerPart();
    public function equals(IntegerPartInterface $integerPart);
}