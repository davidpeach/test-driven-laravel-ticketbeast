<?php

namespace App;

class Reservation
{
    private $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    public function totalCost()
    {
        return $this->tickets->sum('price');
    }

    public function cancel()
    {
        $this->tickets->each->release();
    }

    public function tickets()
    {
        return $this->tickets;
    }
}
