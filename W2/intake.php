<?php
    if (isset($_POST['storePatient'])) {
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_VALIDATE_STRING);
    }
    $error = "";
    if ($first_name = ""){
        $error .= "<li>Please Enter the First Name</li>";
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

    </style>

</head>

<body>

    <div class="navbar">
        <a href="mainpage.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn" onclick="dropDown()">Assignments
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="../W1/index.php" target="_blank">Week 1 - Fizz Buzz</a>
                    <a href="mainpage.php">Week 2 - Main Course Page</a>
                    <a href="intake.php" target="_blank">Week 2 - Patient Intake Form</a>
                    <a href="">Week 3 - None</a>
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
            grid-template-columns: 180px 400px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        input[type=text] {width: 200px;}
        .error {color: red;}
        div {margin-top: 5px;}
    </style>

    <h2>Patient Intake Form</h2>

    <form name="patient" method="post" action="patient.php">

        <div class="wrapper">

            <div class="label">
                <label>First Name:</label>
            </div>

            <div>
                <input type="text" name="first_name" value="" />
            </div>

            <div class="label">
                <label>Last Name:</label>
            </div>

            <div>
                <input type="text" name="last_name" value="" />
            </div>

            <div class="label">
                <label>Married:</label>
            </div>

            <div>
                <input type="radio" name="married" value="yes"  >Yes

                    
                <input type="radio" name="married" value="no"   />No
                
            </div>

            <div class="label">
                <label>Conditions:</label>
            </div>
            
            <div>
                <input type="checkbox"  name="conditions[]" value="High Blood Pressure">High Blood Pressure
                <input type="checkbox"  name="conditions[]" value="Diabetes">Diabetes
                <input type="checkbox"  name="conditions[]" value="Heart Condition">Heart Condition
            </div>

            <div class="label">
                <label>Birth Date:</label>
            </div>

            <div>
                <input type="date" name="birth_date" value="" />
            </div>

            <div class="label">
                <label>Height:</label>
            </div>

            <div>
                Feet: <input type="text" name="ft" value="" style="width:40px;" />
                Inches: <input type="text" name="inches" value="0" style="width:40px;" />
            </div>

            <div class="label">
                <label>Weight (pounds):</label>
            </div>
            
            <div>
                <input type="text" name="weight" value=""  style="width:40px;" />
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