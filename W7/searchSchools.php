<?php
    session_start();

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    include __DIR__ . '/sqlstuff/schoolsModel.php';

    $nameSearch = "";
    $citySearch = "";
    $stateSearch = "";

    $searched = FALSE;

    if(isPostRequest()){
        $searchName = filter_input(INPUT_POST, 'nameSearch');
        $searchCity = filter_input(INPUT_POST, 'citySearch');
        $searchState = filter_input(INPUT_POST, 'stateSearch');

        $schools = getSchools($nameSearch, $citySearch, $stateSearch);

        $searched = TRUE;

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
            padding: 4px 55px;
            text-decoration: none;
        }
        .navbar a:hover{
            background-color: #FF8C00;
        }
        li {
            font-family: "Times New Roman", Times, serif;
            font-size: "16px;";
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
        .container div a:hover, .container div table tbody td a:hover, .container div table tbody td form button:hover{
            background-color: black;
        }
        input[type=text] {
            width: 20%;
            color: black;
            background-color: white;
        }
        .btn{
            --bs-btn-border-color: white;
            --bs-btn-hover-border-color: #CC5500;
            color: white;
        }
        .table {
            --bs-table-color: white;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="../W2/mainpage/mainpage.php">Home</a>
        <a href="../W2/mainpage/mainpage.php">Assignments</a>
        <a href="../W2/mainpage/php_resources.php">PHP Resources</a>
        <a href="../W2/mainpage/git_resources.php">Git Resources</a>
        <a href="../W2/mainpage/hobbies.php">Hobbies</a>
        <a href="https://github.com/burns115/SE266" target="_blank">Ryan's GitHub Repo</a>
    </div>
    <div class='container'>

        <?php if(!isset($_SESSION['uploaded']) OR !$_SESSION['uploaded']):?> 
            <br />
            <h3 style='text-align:center;'>No file was uploaded. Please go to the <a href='schoolUpload.php'>upload page</a> to upload one.</h3>
        <?php elseif ($_SESSION['uploaded']):?>

            <h2>Search Schools</h2>

            <form action='searchSchools.php' method='post'>

                <div class='form-group'>
                    <label for='nameInput'>School name</label>
                    &nbsp;
                    <input type='text' name='nameInput' class='form-control' value="<?=$nameSearch?>" />
                </div>

                <div class='form-group'>
                    <label for='cityInput'>City</label>
                    &nbsp;
                    <input type='text' name='cityInput' class='form-control' value="<?=$citySearch?>" />
                </div>
                
                <div class='form-group'>
                    <label for='stateInput'>State</label>
                    &nbsp;
                    <input type='text' name='stateInput' class='form-control' maxlength='2' value="<?=$stateSearch?>" />
                </div>

                <br />

                <button type='submit' class='btn'>Search</button>

            </form>
            

        <?php endif;?>

        <?php if($searched):?>

            <br />
            <p><?=count($schools)?> matching schools found.</p>

            <table class='table table-striped'>

            <thead>

                <tr>
                    <th>School Name</th>
                    <th>City</th>
                    <th>State</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($schools as $row):?>
                    <tr>
                        <td><?= $row['sclName'] ?></td>

                        <td><?= $row['sclCity'] ?></td>

                        <td><?= $row['sclState'] ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

            </table>

        <?php endif;?>

    </div>
</body>
</html>