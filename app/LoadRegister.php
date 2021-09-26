<?php

namespace App;

use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Statement;
use League\Csv\TabularDataReader;


class LoadRegister
{
    private string $file;
    private Reader $csvReader;
    private Writer $csvWriter;

    public function __construct(string $file)
    {
        $this->csvReader = $csv = Reader::createFromPath($file, 'r');
        $this->csvReader->setHeaderOffset(0);
        $this->csvReader->setDelimiter(',');

        $this->csvWriter = Writer::createFromPath($file, 'a+');
    }


    public function getRecords(): TabularDataReader
    {
        return Statement::create()->process($this->csvReader);
    }

    public function headers(): array
    {
        return $this->csvReader->getHeader();
    }

    /**
     * @throws \League\Csv\CannotInsertRecord
     */
    public function writeData(string $fName, string $lName, string $pCode, string $addInfo): void
    {
        $message = [$fName, $lName, $pCode, $addInfo];
        $this->csvWriter->insertOne($message);
    }
}