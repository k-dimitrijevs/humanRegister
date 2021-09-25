<?php

require_once "vendor/autoload.php";

use App\LoadRegister;
use App\AddPerson;
use League\Csv\Writer;

$humanRegister = new LoadRegister("register.csv");
$humanData = $humanRegister->getRecords();


if (isset($_POST['add']))
{
    $writer = Writer::createFromPath("register.csv", 'a+');
    $writer->setNewline("\r\n");
    $writer->insertOne([
       $_POST['FirstName'],     
       $_POST['LastName'],
       $_POST['PersonalCode'],
       $_POST['AdditionalInfo']
    ]);
    header("Refresh: 0");
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Human register</title>
</head>
<body style="padding-top: 50px">
<div class="container">
    <div class="row">
        <h4>Search by Personal Code</h4>
        <div class="col-md-6">
            <form method="post">
                <label for="PersonalCode">Personal code:</label><br>
                <input class="form-control" type="text" id="PersonalCode" name="PersonalCode" placeholder="Enter Personal Code"><br>
                <button type="submit" name="search" class="btn btn-primary">Search</button><br><br>
            </form>
        </div>
        <div class="col-md-6">
            <?php
            if (isset($_POST['search']))
            {
                foreach ($humanData as $personData)
                {
                    if ($personData['PersonalCode'] === $_POST['PersonalCode'])
                    {
                        $output = "{$personData['FirstName']} {$personData['LastName']} {$personData['PersonalCode']} {$personData['AdditionalInfo']}";
                        break;
                    } else {
                        $output = "Person with that personal code does not exist in register";
                    }
                }
                echo "<p style='padding-top: 30px'>{$output}</p>";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <hr>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Add new Person</h3>
            <form method="post">
                <label for="FirstName">First name:</label><br>
                <input class="form-control" type="text" id="FirstName" name="FirstName" placeholder="Enter first name"><br>

                <label for="LastName">Last name:</label><br>
                <input class="form-control" type="text" id="LastName" name="LastName" placeholder="Enter last name"><br>

                <label for="PersonalCode">Personal code:</label><br>
                <input class="form-control" type="text" id="PersonalCode" name="PersonalCode" placeholder="Enter Personal Code"><br>

                <label for="AdditionalInfo">Additional information:</label><br>
                <textarea class="form-control" id="AdditionalInfo" name="AdditionalInfo" rows="3" placeholder="Additional information if needed"></textarea><br>

                <button type="submit" name="add" class="btn btn-primary">Add</button><br><br>
            </form>
        </div>
    </div>

    <div class="row">
        <hr>
    </div>

    <div class="row">
        <table class="table">
            <tbody>
            <?php foreach ($humanData as $personData): ?>
                <tr>
                    <td><?php echo $personData["FirstName"]; ?></td>
                    <td><?php echo $personData["LastName"]; ?></td>
                    <td><?php echo $personData["PersonalCode"]; ?></td>
                    <td><?php echo $personData["AdditionalInfo"]; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>