<?php

namespace App;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;


class LoadRegister
{
    private string $file;
    private Reader $csvReader;

    public function __construct(string $file)
    {
        $this->csvReader = $csv = Reader::createFromPath($file, 'r');
        $this->csvReader->setHeaderOffset(0);
        $this->csvReader->setDelimiter(',');
    }


    public function getRecords(): TabularDataReader
    {
        return Statement::create()->process($this->csvReader);
    }
}