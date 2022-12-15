<?php

    include __DIR__ . '/sqlstuff/patientsModel.php';

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    if(isset($_GET['action'])){

        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'patientID');
    

        if($action == "edit"){
            $row = getAPatient($id);

            $fName = $row['patientFirstName'];

            $lName = $row['patientLastName'];

            $married = $row['patientMarried'];

            $birth = $row['patientBirthDate'];

        }else{
            $fName = '';

            $lName = '';

            $married = '';

            $birth = '';
        }

    } elseif (isset($_POST['action'])){
        $action = filter_input(INPUT_POST, 'action');

        $id = filter_input(INPUT_POST, 'patientID');
        
        $fName = filter_input(INPUT_POST, 'patientFirstName');
        
        $lName = filter_input(INPUT_POST, 'patientLastName');
        
        $married = filter_input(INPUT_POST, 'patientMarried');
        
        $birth = filter_input(INPUT_POST, 'patientBirthDate');
    }

    if (isPostRequest() AND $action == 'add'){

        var_dump($_POST);
        $result = addPatient($fName, $lName, $married, $birth); 

        header('Location: viewPatients.php'); 

    } elseif (isPostRequest() AND $action == 'edit'){

        $result = editPatient($id, $fName, $lName, $married, $birth); 

        header('Location: viewPatients.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style type="text/css">
        .navbar{
            overflow: hidden;
            background-color: #CC5500;
            font-family: Arial, Helvetica, sans-serif;
        }
        div{
            display: block;
        }
        body{
            background-color: black;
            color: white;
            display: block;
            margin: 8px;
            font-family: "Times New Roman", Times, serif;
            font-size: "16px;";
            margin-left: 20px;
            margin-right: 10px;
        }
        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 55px;
            text-decoration: none;
        }
        .navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
            background-color: #FF8C00;
        }
        li {
            font-family: "Times New Roman", Times, serif;
            font-size: "16px;";
        }
        .dropdown {
            float: left;
            overflow: hidden;
        }
        .dropdown .dropbtn {
            cursor: pointer;
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 66px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            float: none;
            background-color: #FF8C00;
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .show {
            display: block;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid white;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
    <title>Edit Patient</title>
</head>
<body>
    <div class="navbar">
        <a href="../W2/mainpage/mainpage.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn" onclick="dropDown()">Assignments
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="../W1/index.php">Week 1 - Fizz Buzz</a>
                    <a href="../W2/mainpage/mainpage.php" >Week 2 - Main Course Page</a>
                    <a href="../W2/intake/intake.php">Week 2 - Patient Intake Form</a>
                    <a href="atm_starter.php">Week 3 - ATM Simulator</a>
                    <a href="">Week 4 - None</a>
                    <a href="">Week 5 - None</a>
                    <a href="">Week 6 - None</a>
                    <a href="">Week 7 - None</a>
                    <a href="">Week 8 - None</a>
                    <a href="">Week 9 - None</a>
                    <a href="">Week 10 - None</a>
                </div>
            </div>  
        <a href="php_resources.php">PHP Resources</a>
        <a href="git_resources.php">Git Resources</a>
        <a href="hobbies.php">Hobbies</a>
        <a href="https://github.com/burns115/SE266" target="_blank">Ryan's GitHub Repo</a>
    </div>

    <div class="container">

        <?php if (($action == 'add') OR (empty($_GET) AND empty($_POST))): ?>
            <h2>Add Patient</h2>

        <?php elseif($action == 'edit'): ?> 
            <h2>Edit Patient Information</h2>

        <?php endif; ?>

        <form class="form-horizontal" action = 'editPatient.php' method='post'>

            <input type='hidden' name='action' value='<?= $action ?>'>
            <input type='hidden' name='patientID' value='<?= $id ?>'>
            <br/>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='patientFirstName'>First name:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='patientFirstName' name='patientFirstName' value='<?= $fName ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='patientLastName'>Last name:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='patientLastName' name='patientLastName' value='<?= $lName ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='patientMarried'>Married:</label>

                <div class='col-sm-10'>
                <?php if ($married == 1): ?>
                    <input type="radio" name="patientMarried" value="1" checked>Yes <input type="radio" name="patientMarried" value="0">No

                <?php elseif($married == 0): ?>
                    <input type="radio" name="patientMarried" value="1">Yes <input type="radio" name="patientMarried" value="0" checked>No

                <?php else:?>
                    <input type="radio" name="patientMarried" value="1">Yes <input type="radio" name="patientMarried" value="0">No

                <?php endif;?>
                </div>
            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='patientBirthDate'>Date of Birth:</label>

                <div class='col-sm-10'>
                    <input type="date" name="patientBirthDate" value='<?= $birth ?>'>
                </div>
            </div>
            <br/>
            <div class='form-group'>

                <div class='col-sm-offset-2 col-sm-10'>

                    <button type="submit" class='btn btn-primary'>Submit</button>

                    <?php

                        if(isPostRequest()){
                            echo "Failed to Add Patient";
                        }
                    ?>
                </div>
            </div>
        </form>

        <br/><br/>

        <a href='./viewPatients.php' class="btn btn-default">View Patients</a>
    </div>
</body>
</html>