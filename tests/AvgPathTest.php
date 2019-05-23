<?php

use App\Action\Turn;
use App\Action\Walk;
use App\Path;
use App\PathCollector;
use App\Position;
use App\Result;
use PHPUnit\Framework\TestCase;

class AvgPathTest extends TestCase
{
    public function testAvgPath()
    {
        $pathCollector = new PathCollector();

        $start1 = new Position(30, 40, 90);
        $path1 = new Path($start1);
        $path1->addAction(new Walk(5));
        $pathCollector->addPath($path1);

        $start2 = new Position(40, 50, 180);
        $path2 = new Path($start2);
        $path2->addAction(new Walk(10));
        $path2->addAction(new Turn(90));
        $path2->addAction(new Walk(5));
        $pathCollector->addPath($path2);

        $result = Result::calc($pathCollector);

        $this->assertEqualsWithDelta($result->getPosition()->x(), 30, 0.01);
        $this->assertEqualsWithDelta($result->getPosition()->y(), 45, 0.01);
        $this->assertEqualsWithDelta($result->getWorstDistance(), 0, 0.01);
    }
}