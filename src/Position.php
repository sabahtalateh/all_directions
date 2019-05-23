<?php

namespace App;

class Position
{
    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * @var float
     */
    private $angle;

    /**
     * Position constructor.
     * @param float $x
     * @param float $y
     * @param float $angle
     */
    public function __construct(float $x = 0.0, float $y = 0.0, float $angle = 0.0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->angle = $angle;
    }

    /**
     * @return float
     */
    public function x()
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function y()
    {
        return $this->y;
    }

    /**
     * @return float
     */
    public function angle(): float
    {
        return $this->angle;
    }
}