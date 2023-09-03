<?php

if (isset($_POST['log_in'])){

    header('Location: login.php');
}

if (isset($_POST['sign_up'])){

    header('Location: signup.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
    font: 15px/1.5 Arial, Helvetica, sans-serif;
    padding-top: 200px;
    margin: 0 auto;
    background-color: hsla(139, 61%, 63%, 0.248);
    text-align:center ;
    min-height:400px;
    }
    .submit{
    width:90px;
    font: 15px/2 Arial, Helvetica, sans-serif;
    border:solid;
    padding:10px 0;
    line-height:10px;
    cursor: pointer;
    background: rgb(95, 155, 108);
    }
    
    .submit:hover {
    background: black;
    color:white;
    }

    </style>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <br><br><img src="dollar.jpg" width="70px"><br>
    <h2>Welcome To Bloggers Community<h2>
    <input type="submit" value="LOG IN" name="log_in" class="submit">
    <input type="submit" value="SIGN UP" name="sign_up" class="submit">
</form>
</body>
</html> 