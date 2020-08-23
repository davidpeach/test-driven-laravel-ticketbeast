<?php

namespace App\Billing;

use App\Billing\PaymentGateway;

class FakePaymentGateway implements PaymentGateway
{
    private $charges;

    private $beforeFirstChargeCallback;

    public function __construct()
    {
        $this->charges = collect();
    }

    public function getValidTestToken()
    {
        return 'valid-token';
    }

    public function charge(int $amount, string $token)
    {
        if ($this->beforeFirstChargeCallback !== null) {
            $this->beforeFirstChargeCallback->__invoke($this);
        }

        if ($token !== $this->getValidTestToken()) {
            throw new PaymentFailedException;
        }
        $this->charges[] = $amount;
    }

    public function totalCharges(): int
    {
        return $this->charges->sum();
    }

    public function beforeFirstCharge($callback)
    {
        $this->beforeFirstChargeCallback = $callback;
    }
}
