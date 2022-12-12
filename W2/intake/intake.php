<?php 

    function bmi($ftHeight, $inHeight, $weight){
        $height = (($ftHeight * 12) + $inHeight) * 0.0254;
        $weight = $weight / 2.20462;

        $bmi = $weight / ($height * $height);

        return $bmi;
    }

    function age($birth){
        $presentDate = new DateTime();

        $bdate = new DateTime($birth);

        $interval = $presentDate->diff($bdate);

        return $interval->y;
    }

    function bmiDescription($bmi){
        if($bmi >= 30) {
            return "Obese";
        }

        elseif ($bmi >= 25) {
            return "Overweight";
        }

        elseif ($bmi >= 18.5) {
            return "Healthy weight";
        }

        else{
            return "Underweight";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        head{display: none;}
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
            padding: 14px 55px;
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

        .error {
            color: red;
        }

    </style>

</head>

<body>

    <div class="navbar">
        <a href="../mainpage/mainpage.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn" onclick="dropDown()">Assignments
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="../../W1/index.php">Week 1 - Fizz Buzz</a>
                    <a href="../mainpage/mainpage.php">Week 2 - Main Course Page</a>
                    <a href="intake.php">Week 2 - Patient Intake Form</a>
                    <a href="../../W3/atm_starter.php">Week 3 - ATM Simulator</a>
                    <a href="../../W4/viewPatients.php">Week 4 - Patient Listing</a>
                    <a href="">Week 5 - None</a>
                    <a href="">Week 6 - None</a>
                    <a href="">Week 7 - None</a>
                    <a href="">Week 8 - None</a>
                    <a href="">Week 9 - None</a>
                    <a href="">Week 10 - None</a>
                </div>
            </div>  
        <a href="../mainpage/php_resources.php">PHP Resources</a>
        <a href="../mainpage/git_resources.php">Git Resources</a>
        <a href="../mainpage/hobbies.php">Hobbies</a>
        <a href="https://github.com/burns115/SE266" target="_blank">Ryan's GitHub Repo</a>
    </div>

    <script>
        
        function dropDown() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(e) {
            if (!e.target.matches('.dropbtn')) {
                var myDropdown = document.getElementById("myDropdown");
                if (myDropdown.classList.contains('show')) {
                    myDropdown.classList.remove('show');
                }
            }
        }

    </script>

    <style type="text/css">
       .wrapper {
            display: grid;
            grid-template-columns: 150px 400px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        dt {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        input[type=text] {width: 200px;}
        .error {color: red;}
        div {margin-top: 5px;}
    </style>

    <?php
        $fname = $lname = $married = $birth = $ftHeight = $inHeight = $weight = $age = "";

        $error = "";

        if (isset($_POST['storePatient'])){

            $fname = filter_input(INPUT_POST, 'fname');
            if ($fname == "") {
                $error .= "<li>Please provide first name</li>";
            }
            
            $lname = filter_input(INPUT_POST, 'lname');
            if ($lname == "") {
                $error .= "<li>Please provide last name</li>";
            }
            
            $married = filter_input(INPUT_POST, 'married');
            if ($married == "") {
                $error .= "<li>Please select a marital status</li>";
            }
        
            $birth = filter_input(INPUT_POST, 'birth');
            if ($birth == "") {
                $error .= "<li>Please select a valid date</li>";
            }
        
            $ftHeight = filter_input(INPUT_POST, 'ftHeight', FILTER_VALIDATE_FLOAT);
            if ($ftHeight == "" or (int) $ftHeight <= 0 ) {
                $error .= "<li>Please enter a valid height (ft.)</li>";
            }
    
            $inHeight = filter_input(INPUT_POST, 'inHeight', FILTER_VALIDATE_FLOAT);
            if ($inHeight == "" or (int) $inHeight < 0 or (int) $inHeight > 11) {
                $error .= "<li>Please enter a valid height (in.)</li>";
            }
    
            $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
            if ($weight == "" or (float) $weight <= 0 ) {
                $error .= "<li>Please enter a valid weight</li>";
            }
    
            if ($error != "") {
                echo "<p class='error'>Please fix the following and resubmit</p>";
                echo "<ul class='error'>$error</ul>";
            } else{

                $bmi = bmi($ftHeight, $inHeight, $weight);
                $bmi = round($bmi, 1);
                $classification = bmiDescription($bmi);
                $age = age($birth);

                require "patient.php";
            }
        }
    ?>
    
    <h2>Patient Intake Form</h2>

    <form name="intake" method="post" action="intake.php">

        <div class="wrapper">

            <div class="label">
                <label>First Name:</label>
            </div>

            <div>
                <input type="text" name="fname" value="<?php echo $fname;?>" />
            </div>

            <div class="label">
                <label>Last Name:</label>
            </div>

            <div>
                <input type="text" name="lname" value="<?php echo $lname;?>" />
            </div>

            <div class="label">
                <label>Married:</label>
            </div>

            <div>
                <?php if ($married == "Yes"): ?>
                    <input type="radio" name="married" value="Yes" checked>Yes
                    <input type="radio" name="married" value="No">No

                <?php elseif ($married == "No"): ?>
                    <input type="radio" name="married" value="Yes">Yes
                    <input type="radio" name="married" value="No" checked>No

                <?php else: ?>
                    <input type="radio" name="married" value="Yes">Yes
                    <input type="radio" name="married" value="No">No
                <?php endif; ?>
            </div>

            <div class="label">
                <label>Birth Date:</label>
            </div>

            <div>
                <input type="date" name="birth" value="<?php echo $birth;?>" />
            </div>

            <div class="label">
                <label>Height:</label>
            </div>

            <div>
                Feet: <input type="text" name="ftHeight" value="<?php echo $ftHeight;?>" style="width:40px;" />
                Inches: <input type="text" name="inHeight" value="<?php echo $inHeight;?>" style="width:40px;" />
            </div>

            <div class="label">
                <label>Weight (pounds):</label>
            </div>
            
            <div>
                <input type="text" name="weight" value="<?php echo $weight;?>" style="width:40px;" />
            </div>

            <div>
                &nbsp;
            </div>

            <div>
                <input type="submit" name="storePatient" value="Store Patient Information" />
            </div>
        
        </div>
    
    </form>
    
    <hr/>

    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
    ?>

</body>
</html>