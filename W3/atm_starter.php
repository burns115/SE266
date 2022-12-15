<?php

    include "checking.php";
    include "savings.php";

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    if(isPostRequest()){
        $checkingBalance = filter_input(INPUT_POST, 'checkingBalance', FILTER_VALIDATE_FLOAT);
        $checkingDate = filter_input(INPUT_POST, 'checkingDate');
        $checkingAccountId = filter_input(INPUT_POST, 'checkingAccountId');

        $savingsBalance = filter_input(INPUT_POST, 'savingsBalance', FILTER_VALIDATE_FLOAT);
        $savingsDate = filter_input(INPUT_POST, 'savingsDate');
        $savingsAccountId = filter_input(INPUT_POST, 'savingsAccountId');
    } else {
        $checkingBalance = 1000;
        $checkingDate = '12-20-2019';
        $checkingAccountId = 'C123';
        
        $savingsBalance = 5000;
        $savingsDate = '3-20-2020';
        $savingsAccountId = 'S123';
    }

    $checking = new CheckingAccount($checkingAccountId, $checkingBalance, $checkingDate);
    $savings = new SavingsAccount($savingsAccountId, $savingsBalance, $savingsDate);

    if (isset ($_POST['withdrawChecking'])) 
    {
        $checking->withdrawal(filter_input(INPUT_POST, 'checkingWithdrawAmount', FILTER_VALIDATE_FLOAT));
    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        $checking->deposit(filter_input(INPUT_POST, 'checkingDepositAmount', FILTER_VALIDATE_FLOAT));
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        $savings->withdrawal(filter_input(INPUT_POST, 'savingsWithdrawAmount', FILTER_VALIDATE_FLOAT));
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        $savings->deposit(filter_input(INPUT_POST, 'savingsDepositAmount', FILTER_VALIDATE_FLOAT));
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <a href="../W4/viewPatients.php">Week 4 - Patient Listing</a>
                    <a href="../W6/login.php">Week 6 - Patient Search</a>
                    <a href="">Week 7 - None</a>
                    <a href="">Week 9/10 - None</a>
                </div>
            </div>  
        <a href="../W2/mainpage/php_resources.php">PHP Resources</a>
        <a href="../W2/mainpage/git_resources.php">Git Resources</a>
        <a href="../W2/mainpage/hobbies.php">Hobbies</a>
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

    <form method="post">
       
        <input type="hidden" name="checkingAccountId" value="<?=$checking->getAccountId()?>" />
        <input type="hidden" name="checkingDate" value="<?=$checking->getStartDate()?>" />
        <input type="hidden" name="checkingBalance" value="<?=$checking->getBalance()?>" />
        <input type="hidden" name="savingsAccountId" value="<?=$savings->getAccountId()?>" />
        <input type="hidden" name="savingsDate" value="<?=$savings->getStartDate()?>" />
        <input type="hidden" name="savingsBalance" value="<?=$savings->getBalance()?>" />
        
        <h1>ATM</h1>
    
        <div class="wrapper">
            
            <div class="account">

                <div class="accountInner">
                    <h2>Checking Account</h2>
                    <li>Account ID: <?=$checking->getAccountId()?></li>
                    <li>Balance: <?=$checking->getBalance()?></li>
                    <li>Start Date: <?=$checking->getStartDate()?></li>
                </div>

                <div class="accountInner">
                    <input type="text" name="checkingWithdrawAmount" value="" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="checkingDepositAmount" value="" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
            
            </div>

            <div class="account">
               
                <div class="accountInner">
                    <h2>Savings Account</h2>
                    <li>Account ID: <?=$savings->getAccountId()?></li>
                    <li>Balance: <?=$savings->getBalance()?></li>
                    <li>Start Date: <?=$savings->getStartDate()?></li>
                </div>

                <div class="accountInner">
                    <input type="text" name="savingsWithdrawAmount" value="" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="savingsDepositAmount" value="" />
                    <input type="submit" name="depositSavings" value="Deposit" /><br />
                </div>
            
            </div>
            
        </div>
    </form>
    <br>
    <hr />
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
    ?>
</body>
</html>
