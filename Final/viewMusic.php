<?php
session_start();

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    if($_SESSION['loggedIn'] == FALSE OR !isset($_SESSION['loggedIn'])){
        header('Location: login.php');
    }

    include __DIR__ . '/sqlstuff/musicModel.php';

    $searchTitle = "";
    $searchArtist = "";
    $searchCom = "";
    $searchGenre = "";
    $searchReleased = "";

    if(isPostRequest()){

        $searchTitle = filter_input(INPUT_POST, 'titleInput');
        $searchArtist = filter_input(INPUT_POST, 'artistInput');
        $searchCom = filter_input(INPUT_POST, 'comInput');
        $searchGenre = filter_input(INPUT_POST, 'genreInput');
        $searchReleased = filter_input(INPUT_POST, 'releasedInput');

        if(isset($_POST['musicID'])){
            $musicID = filter_input(INPUT_POST, 'musicID');
            deleteRecord($musicID);
        }
    }

    $records = getRecord($searchTitle, $searchArtist, $searchCom, $searchGenre, $searchReleased);
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
            padding: 4px 56.5px;
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
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
        .container div a:hover, .container div table tbody td a:hover, .container div table tbody td form button:hover{
            --bs-btn-border-color: #DB9D00;
        }
        input[type=text] {
            width: 150px;
            color: black;
            background-color: #BABCC9;
        }
        .btn{
            --bs-btn-border-color: #e6c36b;
            --bs-btn-bg: #1416190d;
            color: black;
        }
        .table{
            --bs-table-border-color: #ecc681;
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
    
    <div class="container">

        <div class="col-sm-12">

            <br/>

            <h1>Melody Museum</h1>

            <table class="table text-light">
                <tr>
                    <form method='post' action='viewMusic.php'>
                        <td><input type="text" placeholder="Song Title" name="titleInput"></td>
                        <td><input type="text" placeholder="Artist Name" name="artistInput"></td>
                        <td><input type="text" placeholder="Record Company" name="comInput"></td>
                        <td><input type="text" placeholder="Genre" name="genreInput"></td>
                        <td>Released: <input type="radio" name="releasedInput" value="1">Yes <input type="radio" name="releasedInput" value="0">No </td>
                        <td><button type="submit" class="btn text-dark">Search</button></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </form>
                </tr>
            </table>

            <table class="table text-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Song Title</th>
                        <th>Artist Name</th>
                        <th>Record Company</th>
                        <th>Genre</th>
                        <th>Song Duration (sec.)</th>
                        <th>Released</th>
                        <th>Release Date</th>
                        <th>Press 'Edit'</th>
                        <th>Press 'Delete'</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?= $row['musicID'] ?></td>
                            <td><?= $row['songTitle'] ?></td>
                            <td><?= $row['artistName'] ?></td>
                            <td><?= $row['recordCom'] ?></td>
                            <td><?= $row['genre'] ?></td>
                            <td><?= $row['songDuration'] ?></td>
                            <td>
                                <?php if ($row['released'] == 1): ?>
                                    Yes
                                <?php else: ?>
                                    No
                                <?php endif; ?>
                            </td>
                            <td><?= $row['releaseDate'] ?></td>
                            <td><a href='editMusic.php?action=edit&musicID=<?=$row['musicID']?>' class="btn text-dark">Edit</a></td>

                            <td>
                                <form action="viewMusic.php" method="post">
                                    <input type="hidden" name="musicID" value="<?= $row['musicID'] ?>" />
                                    
                                    <button type="submit" class="btn text-dark">Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br />
            <a href="editMusic.php?action=add" class="btn text-dark">Add Music</a>
            <br />
            <br />
            <a href="logout.php" class="btn text-dark">Logout</a>
        </div>
    </div>
</body>
</html>