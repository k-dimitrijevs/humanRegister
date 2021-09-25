<?php

namespace App;

use League\Csv\Writer;

class AddPerson
{
    private Writer $csvWriter;
    private string $file;

    private string $firstName;
    private string $lastName;
    private string $personalCode;
    private ?string $additionalInfo = "";


    public function __construct(string $file)
    {
        $this->csvWriter = $csv = Writer::createFromPath($file, 'a+');
    }

    public function insertPersonData(string $firstName, string $lastName, string $personalCode, ?string $additionalInfo): void
    {
        $this->csvWriter->insertOne([$firstName, $lastName, $personalCode, $additionalInfo]);
    }
}