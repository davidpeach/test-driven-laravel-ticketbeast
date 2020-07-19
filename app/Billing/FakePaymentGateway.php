<?php

namespace App\Billing;

use App\Billing\PaymentGateway;

class FakePaymentGateway implements PaymentGateway
{
    private $charges;

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
        if ($token !== $this->getValidTestToken()) {
            throw new PaymentFailedException;
        }
        $this->charges[] = $amount;
    }

    public function totalCharges(): int
    {
        return $this->charges->sum();
    }
}
