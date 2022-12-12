<?php
    include __DIR__ . '/sqlstuff/patientsModel.php';

    $patients = getPatients();

    if(isPostRequest()){
        $id = filter_input(INPUT_POST, 'patientID');
        deletePatient($id);
    }

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
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
        .navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
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
        .container div a:hover {
            background-color: #CC5500;
        }
        .container div table tbody td a:hover {
            background-color: #CC5500;
        }
        .container div table tbody td form button:hover {
            background-color: #CC5500;
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
    
    <div class="container">

        <div class="col-sm-12">

            <br/>

            <h1>Patients</h1>

            <br/>

            <a href="editPatient.php?action=add" class="btn text-light">Add Patient</a>

            <br /><br />

            <table class="table text-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birthdate</th>
                        <th>Press 'Edit'</th>
                        <th>Double-click 'Delete'</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['patientFirstName'] ?></td>
                            <td><?= $row['patientLastName'] ?></td>
                            <td>
                                <?php if ($row['patientMarried'] == 1): ?>
                                    Yes
                                <?php else: ?>
                                    No
                                <?php endif; ?>
                            </td>
                            <td><?= $row['patientBirthDate'] ?></td>
                            <td><a href='editPatient.php?action=edit&patientID=<?=$row['id']?>' class="btn text-light">Edit</a></td>

                            <td>
                                <form action="viewPatients.php" method="post">
                                    <input type="hidden" name="patientID" value="<?= $row['id'] ?>" />
                                    
                                    <button type="submit" class="btn text-light">Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br />
            <a href="editPatient.php?action=add" class="btn text-light">Add Patient</a>
        </div>
    </div>
</body>
</html>