<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model;

final class CurrencyAmount
{
    private $value;

    public function __construct(float $value)
    {
        if (\BolCom\RetailerApi\Model\Assert\AssertCurrency::date($value)) {
            throw new \InvalidArgumentException('');
        }

        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public static function fromScalar(float $currencyAmount): CurrencyAmount
    {
        return new self($currencyAmount);
    }

    public function toScalar(): float
    {
        return $this->value;
    }
}
