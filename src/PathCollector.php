<?php

namespace App;

class PathCollector
{
    /**
     * @var Path[]
     */
    private $paths = [];

    /**
     * @var Position[]
     */
    private $finalPositions = [];

    /**
     * @param Path $path
     */
    public function addPath(Path $path): void
    {
        $this->paths[] = $path;
    }

    /**
     * @return Position[]
     */
    public function calculateFinalPositions(): array
    {
        foreach ($this->paths as $path) {
            $this->finalPositions[] = $path->calculateFinalPositions();
        }
        return $this->finalPositions;
    }
}