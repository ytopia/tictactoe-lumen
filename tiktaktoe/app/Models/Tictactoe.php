<?php

namespace App\Models;

/**
 * Class Tictactoe
 * @package App\Models
 */
class Tictactoe
{
    public $row = [0 => 0, 1 => 0, 2 => 0];
    public $column = [0 => 0, 1 => 0, 2 => 0];
    public $rowMap = [1 => 0, 2 => 0, 3 => 0, 4 => 1, 5 => 1, 6 => 1, 7 => 2, 8 => 2, 9 => 2];
    public $columnMap = [1 => 0, 2 => 1, 3 => 2, 4 => 0, 5 => 1, 6 => 2, 7 => 0, 8 => 1, 9 => 2];
    public $diag = 0;
    public $antiDiag = 0;
    public $boardSize = 3;

    /**
     * @param int $r
     * @param int $c
     * @return bool
     */
    private function isWon(int $r, int $c)
    {
        $this->row[$r]++;
        $this->column[$c]++;
        if ($r == $c) {
            $this->diag++;;
        }
        if ($r + $c == $this->boardSize - 1) {
            $this->antiDiag++;
        }
        if ($this->row[$r] == $this->boardSize || $this->column[$c] == $this->boardSize || $this->diag == $this->boardSize || $this->antiDiag == $this->boardSize) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Game $game
     * @param int $uid
     * @param int $step
     * @return array
     * @throws \Exception
     */
    public function checkWin(Game $game, int $uid, int $step)
    {
        $board = [];
        $moveCount = 1;
        $i = 1;
        foreach ($game->toArray() as $key => $value) {
            if (strpos($key, 'field') !== false) {
                $board[$i++] = $value;
                if($value<>-1){
                    $moveCount++;
                }
            }
        }

        if ($game->result <> 'process') {
            throw new \Exception('game ended');
        }
        if ($game->last_uid == $uid || ($game->last_uid == 0 && $game->uid_x <> $uid)) {
            throw new \Exception('wrong user specified');
        }
        if ($board[$step] <> -1) {
            throw new \Exception('field is already taken');
        }

        if ($game->uid_x == $uid) {
            $board[$step] = 1;
            $isX = 1;
        } else if ($game->uid_o == $uid) {
            $board[$step] = 0;
            $isX = 0;
        } else {
            throw new \Exception('user is not involved in the game');
        }

        $status = false;
        foreach ($board as $key => $move) {
            if ($isX == $move) {
                if ($this->isWon($this->rowMap[$key], $this->columnMap[$key])) {
                    $status = true;
                    break;
                }

            }
        }

        $isEnd = $moveCount == pow($this->boardSize, 2);
        if ($status) {
            $result = 'win';
        } else {
            if ($isEnd) {
                $result = 'draw';
            } else {
                $result = 'process';
            }
        }
        return ['is_x' => $isX, 'result' => $result];
    }
}
