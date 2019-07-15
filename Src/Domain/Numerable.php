<?php
/**
 * Created by PhpStorm.
 * User: sikay
 * Date: 15/07/2019
 * Time: 16:23
 */

namespace WeDev\Price\Domain;


abstract class Numerable
{
    protected const EMPTY_STRING = '';
    protected const VALID_NUMBERS = [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1];
}