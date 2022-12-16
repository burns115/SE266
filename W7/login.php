<?php
    include_once __DIR__ . '/sqlstuff/schoolsModel.php';

    function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }

    session_start();//runs the session_start() function

    if(isPostRequest()){
        $uname = filter_input(INPUT_POST, 'inputUname'); 
        $pword = filter_input(INPUT_POST, 'inputPword'); 
    
        $search = getAUser($uname); 

        if ($search != "No user found."){
            $salt = $search['salt'];
            $enc = $search['encPword'];
    
            if(sha1($pword.$salt) == $enc){//if password and username are correct, redirects to uploadSchools.php
                $_SESSION['uname'] = $uname; 
                $_SESSION['loggedIn'] = TRUE; 
                
                header('Location: uploadSchools.php'); 
    
            } else {
                $_SESSION['loggedIn'] = FALSE; 
            }
            
        } else { 
            $_SESSION['loggedIn'] = FALSE;//if pword and uname are incorrect, stay on login page
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
    <style>
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
        .unamebox, .pwordbox{
            background-color: gray;
        }
        .btn{
            border: solid #CC5500;
        }
        .btn:hover{
            border: solid #FF8C00;
        }
        .form-control{
            width: 25%;
        }
    </style>
</head>
<body>
    <div>
        <?php if(isPostRequest()):?>

            <?php if(!$_SESSION['loggedIn'])://Username: rburns Password: rburns?>
                
                
                <div role="alert">Username not found/Password may be incorrect.</div>

            <?php endif;?>

        <?php endif;?>

        <h3>Login</h3>

        <form method='post' action='login.php'>
            <div>
                <label for="inputUname" class="form-label">Username</label>
                <input type="text" class="form-control unamebox" id="inputUname" name='inputUname'>
            </div>
            <br/>
            <div">
                <label for="inputPword" class="form-label">Password</label>
                <input type="password" class="form-control pwordbox" id="inputPword" name='inputPword'>
            </div>
            <br/>
            <button type="submit" style="background-color: #CC5500; outline-color: white" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>
</html>