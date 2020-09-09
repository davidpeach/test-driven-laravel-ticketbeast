<?php

namespace App\Billing;

use App\Billing\PaymentFailedException;
use App\Billing\PaymentGateway;
use Stripe\Charge;

class StripePaymentGateway implements PaymentGateway
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function charge($amount, $token)
    {
        try {
            Charge::create([
                'amount' => $amount,
                'source' => $token,
                'currency' => 'gbp',
            ], ['api_key' => $this->apiKey]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            throw new PaymentFailedException;

        }
    }
}
