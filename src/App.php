<?php

namespace App;

use App\Action\Terminate;

class App
{
    const ROUND_PRECISION = 4;

    public function run()
    {
        $parser = new InputParser();

        while (true) {
            // Read line with number of attempts
            $parser->readStdInLine();
            $numberOfTests = $parser->getNumberOfTests();
            if ($numberOfTests === 0) {
                break;
            }
            $pathCollector = new PathCollector();
            for ($i = 0; $i < $numberOfTests; $i++) {
                // Read line with instructions to do
                $parser->readStdInLine();
                $startPosition = $parser->getStartPosition();
                $path = new Path($startPosition);
                while (true) {
                    $action = $parser->getAction();
                    if ($action instanceof Terminate) {
                        break;
                    }
                    $path->addAction($action);
                }
                $pathCollector->addPath($path);
            }
            $this->printResult($pathCollector);
        }
    }

    /**
     * @param PathCollector $pathCollector
     */
    private function printResult(PathCollector $pathCollector): void
    {
        $result = Result::calc($pathCollector);
        $x = round($result->getPosition()->x(), self::ROUND_PRECISION);
        $y = round($result->getPosition()->y(), self::ROUND_PRECISION);
        $worst = round($result->getWorstDistance(), self::ROUND_PRECISION);
        echo "{$x} {$y} {$worst} \n";
    }
}
