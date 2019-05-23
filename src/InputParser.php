<?php

namespace App;

use App\Action\Action;
use App\Action\Terminate;
use App\Action\Turn;
use App\Action\Walk;

class InputParser
{
    /**
     * @var int
     */
    protected $linesRead = 0;

    /**
     * @var array
     */
    protected $tokens;

    /**
     * @var int
     */
    protected $tokensRead = 0;

    /**
     * Read a Line From STDIN
     */
    public function readStdInLine()
    {
        $this->tokens = explode(" ", trim(fgets(STDIN)));
        $this->linesRead++;
        $this->tokensRead = 0;
    }

    /**
     * @return int
     */
    public function getNumberOfTests(): int
    {
        $numberOfTests = (int)($this->tokens[0] ?? 0);
        return $numberOfTests;
    }

    /**
     * @return Position
     */
    public function getStartPosition(): Position
    {
        if (count($this->tokens) < 4) {
            throw new InvalidInputException("Not Enough Tokens to Read Start Position at Line {$this->linesRead}");
        }

        $start = $this->tokens[2];
        if ($start != 'start') {
            throw new InvalidToken("Invalid 3-rd token `{$start}`. `start` Should be Placed Instead");
        }

        $startX = floatval($this->tokens[0]);
        $startY = floatval($this->tokens[1]);

        $startAngle = $this->tokens[3];
        $startPosition = new Position($startX, $startY, $startAngle);
        $this->tokensRead = 4;
        return $startPosition;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        $token = $this->tokens[$this->tokensRead];
        $value = floatval($this->tokens[$this->tokensRead + 1]);
        switch ($token) {
            case 'turn':
                $action = new Turn($value);
                break;
            case 'walk':
                $action = new Walk($value);
                break;
            default:
                $action = new Terminate;
        }
        $this->tokensRead += 2;
        return $action;
    }
}
