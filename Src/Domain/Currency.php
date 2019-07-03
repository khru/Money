<?php

namespace WeDev\Price;

final class Currency implements \JsonSerializable
{
    private $code;

    public function __construct(string $code)
    {
        if ('' === $code) {
            throw new \InvalidArgumentException('Currency code should not be empty string');
        }

        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function equals(Currency $other): bool
    {
        return $this->code === $other->code;
    }

    public function isAvailableWithin(Currencies $currencies): bool
    {
        return $currencies->contains($this);
    }

    public function __toString(): string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->code;
    }
}
