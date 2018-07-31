<?php

namespace app;

/**
 * Class Task3.
 * @package app
 */
class Task3
{
    const ROW_NUM = 50;
    const ELEMENT = '*';

    /**
     * Draw a half of pyramid (50 rows).
     * @return string Pyramid as string of '*'
     */
    public function drawPyramid()
    {
        $row = $pyramid = '';

        for ($i = 0; $i < self::ROW_NUM; $i++) {
            $row .= self::ELEMENT;
            $pyramid .= "$row\n";
        }

        return nl2br($pyramid);
    }
}