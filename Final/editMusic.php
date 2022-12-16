<?php

    include __DIR__ . '/sqlstuff/musicModel.php';

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    if(isset($_GET['action'])){

        $action = filter_input(INPUT_GET, 'action');
        $musicID = filter_input(INPUT_GET, 'musicID');
    

        if($action == "edit"){
            $row = getARecord($musicID);

            $songTitle = $row['songTitle'];

            $artistName = $row['artistName'];

            $releaseDate = $row['releaseDate'];

            $recordCom = $row['recordCom'];

            $genre = $row['genre'];

            $songDuration = $row['songDuration'];

            $released = $row['released'];

        }else{
            $songTitle = "";

            $artistName = "";

            $releaseDate = "";

            $recordCom = "";

            $genre = "";

            $songDuration = "";

            $released = "";
        }

    } elseif (isset($_POST['action'])){
        $action = filter_input(INPUT_POST, 'action');

        $musicID = filter_input(INPUT_POST, 'musicID');
        
        $songTitle = filter_input(INPUT_POST, 'songTitle');
        
        $artistName = filter_input(INPUT_POST, 'artistName');
        
        $releaseDate = filter_input(INPUT_POST, 'releaseDate');

        $recordCom = filter_input(INPUT_POST, 'recordCom');
        
        $genre = filter_input(INPUT_POST, 'genre');
        
        $songDuration = filter_input(INPUT_POST, 'songDuration');

        $released = filter_input(INPUT_POST, 'released');
    }

    if (isPostRequest() AND $action == 'add'){

        var_dump($_POST);
        $result = addRecord($songTitle, $artistName, $releaseDate, $recordCom, $genre, $songDuration, $released); 

        header('Location: viewMusic.php'); 

    } elseif (isPostRequest() AND $action == 'edit'){

        $result = editRecord($musicID, $songTitle, $artistName, $releaseDate, $recordCom, $genre, $songDuration, $released); 

        header('Location: viewMusic.php');
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
            color: black;
            background-color: #e6c36b;
            font-family: Arial, Helvetica, sans-serif;
        }
        div{
            display: block;
        }
        body{
            background-color: #BABCC9;
            color: black;
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
            color: black;
            text-align: center;
            padding: 14px 56.5px;
            text-decoration: none;
        }
        .navbar a:hover{
            background-color: #c7a95d;
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
        input[type=text] {width: 10%;}
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
        <a href="../W2/mainpage/mainpage.php">Assignments</a>   
        <a href="php_resources.php">PHP Resources</a>
        <a href="git_resources.php">Git Resources</a>
        <a href="hobbies.php">Hobbies</a>
        <a href="https://github.com/burns115/SE266" target="_blank">Ryan's GitHub Repo</a>
    </div>

    <div class="container">

        <?php if (($action == 'add') OR (empty($_GET) AND empty($_POST))): ?>
            <h2>Add Song</h2>

        <?php elseif($action == 'edit'): ?> 
            <h2>Edit Song Information</h2>

        <?php endif; ?>

        <form class="col-lg-6 offset-lg-3" action = 'editMusic.php' method='post'>

            <input type='hidden' name='action' value='<?= $action ?>'>
            <input type='hidden' name='musicID' value='<?= $musicID ?>'>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='songTitle'>Song Title:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='songTitle' name='songTitle' value='<?= $songTitle ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='artistName'>Artist Name:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='artistName' name='artistName' value='<?= $artistName ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='recordCom'>Record Company:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='recordCom' name='recordCom' value='<?= $recordCom ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='genre'>Genre:</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='genre' name='genre' value='<?= $genre ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='songDuration'>Duration (sec.):</label>

                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='songDuration' name='songDuration' value='<?= $songDuration ?>'>
                </div>

            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='released'>Released:</label>

                <div class='col-sm-10'>
                <?php if ($released == 1): ?>
                    <input type="radio" name="released" value="1" checked>Yes <input type="radio" name="released" value="0">No

                <?php elseif($released == 0): ?>
                    <input type="radio" name="released" value="1">Yes <input type="radio" name="released" value="0" checked>No

                <?php else:?>
                    <input type="radio" name="released" value="1">Yes <input type="radio" name="released" value="0">No

                <?php endif;?>
                </div>
            </div>
            <br/>
            <div class="form-group">
                <label class='control-label col-sm-2' for='releaseDate'>Date Released:</label>

                <div class='col-sm-10'>
                    <input type="date" name="releaseDate" value='<?= $releaseDate ?>'>
                </div>
            </div>
            <br/>
            <div class='form-group'>

                <div class='col-sm-offset-2 col-sm-10'>

                    <button type="submit" class='btn btn-primary'>Submit</button>

                    <?php

                        if(isPostRequest()){
                            echo "Failed to Add Record";
                        }
                    ?>
                </div>
            </div>
        </form>

        <br/><br/>

        <a href='./viewMusic.php' class="btn btn-default">View Music</a>
    </div>
</body>
</html>