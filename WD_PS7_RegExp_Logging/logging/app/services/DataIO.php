<?php

namespace app\services;

/**
 * Interface DataIO.
 * Data input and output.
 */
interface DataIO
{
    public function selectData($data);
    public function insertData($data);
}