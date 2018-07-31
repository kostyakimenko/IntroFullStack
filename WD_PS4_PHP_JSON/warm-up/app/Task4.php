<?php

namespace app;

/**
 * Class Task4.
 * @package app
 */
class Task4
{
    const BLACK_CELL = '<div class=chessboard__col_black></div>';
    const WHITE_CELL = '<div class=chessboard__col_white></div>';
    const START_TAG = '<div class=chessboard__row>';
    const END_TAG = '</div>';

    private $rows;
    private $cols;

    /**
     * Task4 constructor.
     * @param $rows string Number of rows
     * @param $cols string Number of column
     */
    public function __construct($rows, $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;
    }

    /**
     * Draw a chessboard of a given size.
     * @return string Chessboard as html
     */
    public function drawChessboard()
    {
        if (!$this->isValidParam()) {
            return 'Error: input parameters must be a positive integer';
        }

        $chessBoard = '';

        for ($row = 0; $row < $this->rows; $row++) {
            $newRow = self::START_TAG;
            for ($col = 0; $col < $this->cols; $col++) {
                if ($row % 2 === 0) {
                    $newRow = ($col % 2 === 0) ? $newRow . self::BLACK_CELL
                                               : $newRow . self::WHITE_CELL;
                } else {
                    $newRow = ($col % 2 === 0) ? $newRow . self::WHITE_CELL
                                               : $newRow . self::BLACK_CELL;
                }
            }
            $chessBoard .= $newRow . self::END_TAG;
        }

        return $chessBoard;
    }

    /**
     * Check input parameters.
     * @return bool Result of validation
     */
    private function isValidParam()
    {
        return is_int($this->rows * 1) && is_int($this->cols * 1)
               && $this->rows > 0 && $this->cols > 0;
    }
}