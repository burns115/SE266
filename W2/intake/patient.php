<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Patient Form</h1>
    <dl class="wrapper">
        <dt><b>Name:</b></dt>
        <?= $fname . " " . $lname ?>
        <br>
        <br>
        <dt><b>Married:</b></dt>
        <?= $married ?>
        <br>
        <br>
        <dt><b>Date of Birth:</b></dt>
        <?= $birth ?>
        <br>
        <br>
        <dt><b>Age:</b></dt>
        <?= $age ?>
        <br>
        <br>
        <dt><b>Weight:</b></dt>
        <?= "$weight lbs" ?>
        <br>
        <br>
        <dt><b>Height:</b></dt>
        <?= "$ftHeight ft $inHeight in" ?>
        <br>
        <br>
        <dt><b>BMI:</b></dt>
        <?= $bmi . " - " . $classification ?>
    </dl>
</body>
</html>