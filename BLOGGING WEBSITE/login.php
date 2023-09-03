
<?php

include('db_connect.php');

$error = array('username'=>'', 'password'=>'');

if (isset($_POST['submit'])){

    $username = $_POST['username'];
     $password = $_POST['password'];
     
     
    // make sql
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT username, firstname, surname, profilepics, cpassword, email, id FROM usersinfo WHERE username = '$username'";
    
    $result = mysqli_query($conn, $sql);

   $user = mysqli_fetch_assoc($result);

  
    

      // check username
       if(empty($username)){
        $error['username'] = 'username cannot be empty';
       }
       else{
        if(!mysqli_num_rows($result) == 1){
         $error['username'] = 'Incorrect username';
       }

       
    }
    // check password
if(empty($password)){
        $error['password'] = 'password cannot be empty';
       }       
 else{

    if(empty($user)){
        // ignore
    }
    elseif (!password_verify($password, $user['cpassword'])){
           $error['password'] = 'Incorrect password';
         }
   
    } 

    
    
    mysqli_free_result($result);
    mysqli_close($conn);

 if(!array_filter($error)){

    session_start();
   $_SESSION['username'] = $user['username'];
   $_SESSION['firstname'] = $user['firstname'];
   $_SESSION['surname'] = $user['surname'];
   $_SESSION['email'] = $user['email'];
   $_SESSION['profilepics'] = $user['profilepics'];


     header('Location: dashboard.php');
    
    }
       
}

?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">

    

        
        <form action="login.php" method="POST">

        <img src="dollar.jpg" width="70px"><br>
        
        <h2>LOG IN</h2>

        <input type="text"placeholder="Username" name="username" value="<?php echo $username ?? ''; ?>"><br>
        
        <div class="error">
            <?php echo $error['username']; ?>
        </div><br><br>
        
        <input type="password"placeholder="Password" name="password" ><br>
        
        <div class="error">
            <?php echo $error['password']; ?>
        </div><br><br>
        
        <button name="submit">Log in</button><br><br>
        </form>
        <div class="signin">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
        
</body>
</html>

