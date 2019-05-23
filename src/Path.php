<?php

namespace App;

use App\Action\Action;
use App\Action\Turn;
use App\Action\Walk;

class Path
{
    /**
     * @var Position[]
     */
    private $positions;

    /**
     * @var Action[]
     */
    private $actions;

    /**
     * Path constructor.
     * @param Position $start
     */
    public function __construct(Position $start)
    {
        $this->positions[] = $start;
    }

    /**
     * @param Action $action
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }

    /**
     * @return Position
     */
    public function calculateFinalPositions(): Position
    {
        foreach ($this->actions as $action) {
            $this->positions[] = $this->calcNewPosition(end($this->positions), $action);
        }
        return end($this->positions);
    }

    /**
     * @return Position[]
     */
    public function getPositions(): array
    {
        return $this->positions;
    }

    /**
     * @param Position $position
     * @param Action $action
     * @return Position
     */
    private function calcNewPosition(Position $position, Action $action): ?Position
    {
        if ($action instanceof Turn) {
            $newAngle = $position->angle() + $action->angle();
            return new Position($position->x(), $position->y(), $newAngle);
        } else if ($action instanceof Walk) {
            $angle = $position->angle();
            $distance = $action->distance();
            $newX = $position->x() + (cos(deg2rad($angle)) * $distance);
            $newY = $position->y() + (sin(deg2rad($angle)) * $distance);
            return new Position($newX, $newY, $position->angle());
        }
        return null;
    }
}