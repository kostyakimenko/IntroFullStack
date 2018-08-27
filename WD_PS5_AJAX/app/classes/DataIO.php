<?php

/**
 * Interface DataIO.
 * Data input and output.
 */
interface DataIO
{
    public function readData();
    public function writeData($data);
}