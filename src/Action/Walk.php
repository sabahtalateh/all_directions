<?php

namespace App\Action;

class Walk implements Action
{
    /**
     * @var float
     */
    private $distance;

    /**
     * Walk constructor.
     * @param float $distance
     */
    public function __construct(float $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function distance(): float
    {
        return $this->distance;
    }
}