<?php

namespace App;

class Result
{
    /**
     * @var Position
     */
    private $position;

    /**
     * @var float
     */
    private $worstDistance;

    /**
     * Result constructor.
     * @param Position $position
     * @param float $worstDistance
     */
    private function __construct(Position $position, float $worstDistance)
    {
        $this->position = $position;
        $this->worstDistance = $worstDistance;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @return float
     */
    public function getWorstDistance(): float
    {
        return $this->worstDistance;
    }

    /**
     * Calculate average position from positions array.
     *
     * @param array $positions
     * @return Position
     */
    private static function avgPosition(array $positions): Position
    {
        $total = count($positions);

        if ($total === 0) {
            throw new NoPositionsToCalculateAverage("No Positions Provided to Calculate Average");
        }

        $sumX = 0.0;
        $sumY = 0.0;
        /** @var Position $position */
        foreach ($positions as $position) {
            $sumX += $position->x();
            $sumY += $position->y();
        }
        $avgX = $sumX / $total;
        $avgY = $sumY / $total;
        return new Position($avgX, $avgY);
    }

    /**
     * @param Position $position
     * @param array $positions
     * @return float
     */
    private static function worstDistance(Position $position, array $positions): float
    {
        $worst = 0.0;
        /** @var Position $p */
        foreach ($positions as $p) {
            $xSqrDistance = pow($p->x() - $position->x(), 2);
            $ySqrDistance = pow($p->y() - $position->y(), 2);
            $distance = sqrt($xSqrDistance + $ySqrDistance);

            if ($distance > $worst) {
                $worst = $distance;
            }
        }

        return $worst;
    }

    /**
     * @param PathCollector $pathCollector
     * @return Result
     */
    public static function calc(PathCollector $pathCollector): Result
    {
        $finalPositions = $pathCollector->calculateFinalPositions();
        $avgPosition = self::avgPosition($finalPositions);
        $worstDistance = self::worstDistance($avgPosition, $finalPositions);

        return new Result($avgPosition, $worstDistance);
    }
}