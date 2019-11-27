<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer;

final class Price
{
    private $value;

    public function __construct(float $value)
    {
        if (!\BolCom\RetailerApi\Model\Assert\AssertCurrency::assert($value)) {
            throw new \InvalidArgumentException('');
        }

        if (!\Assert\Assertion::between($value, 1, 9999, 'Price must be between 1 and 9999.')) {
            throw new \InvalidArgumentException('');
        }

        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public static function fromScalar(float $price): Price
    {
        return new self($price);
    }

    public function toScalar(): float
    {
        return $this->value;
    }
}
