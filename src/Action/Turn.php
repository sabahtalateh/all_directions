<?php

namespace App\Action;

class Turn implements Action
{
    /**
     * @var float
     */
    private $angle;

    /**
     * Turn constructor.
     * @param float $angle
     */
    public function __construct(float $angle)
    {
        $this->angle = $angle;
    }

    /**
     * @return float
     */
    public function angle(): float
    {
        return $this->angle;
    }
}