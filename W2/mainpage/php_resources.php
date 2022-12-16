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
                    <a href="../../W1/index.php">Week 1 - Fizz Buzz</a>
                    <a href="mainpage.php" >Week 2 - Main Course Page</a>
                    <a href="../intake/intake.php">Week 2 - Patient Intake Form</a>
                    <a href="../../W3/atm_starter.php">Week 3 - ATM Simulator</a>
                    <a href="../../W4/viewPatients.php">Week 4 - Patient Listing</a>
                    <a href="../../W6/login.php">Week 6 - Patient Search</a>
                    <a href="../../W7/login.php">Week 7 - File Upload</a>
                    <a href="../../Final/login.php">Week 9/10 - Final</a>
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

    <h2>PHP Resources</h2>

    <ul>
        <li><a href="https://www.tutorialspoint.com/php-resources" target="_blank">Information and Lessons on PHP</a></li>
        <li><a href="https://stackify.com/learn-php-tutorials/" target="_blank">Top 25 PHP Tutorials</a></li>
        <li><a href="https://www.w3schools.com/php/default.asp" target="_blank">W3 Schools PHP Information</a></li>
    </ul>

    <hr />
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
    ?>
</body>
</html>