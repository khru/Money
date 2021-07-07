<?php

namespace WeDev\Price\Domain;

interface IntegerInterface
{
    public function getInteger();

    public function equals(IntegerInterface $integer);
}