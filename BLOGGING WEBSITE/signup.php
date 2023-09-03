<?php 

  require('db_connect.php');

  $error = array('firstname'=>'', 'surname'=>'', 'username'=>'',  'email'=>'', 'password'=>'', 'cpassword'=>'', 'profilepics'=>'');
  
  if(isset($_POST['submit'])){
    $firstname = ($_POST['firstname']);
    $surname = ($_POST['surname']);
    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);
    $profilepics = ($_POST['profilepics']);
    
    include('signup_validation.php');

    if(!array_filter($error)){

      

$options = [ 
    'cost' => 10,
];
$encrypted_password = password_hash($password, PASSWORD_BCRYPT);

// Save the encrypted password to a database or file
      
    // create sql
    $sql = "INSERT INTO usersinfo(firstname, surname, username,  email, profilepics, cpassword) VALUES('$firstname', '$surname', '$username',  '$email', '$profilepics', '$encrypted_password')";

        if(mysqli_query($conn, $sql))
    {
        // connected
       header('Location: welcome.php');
    }
    else
    {
        echo 'query error: ' . mysqli_error($conn); 
    }


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

    
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <img src="dollar.jpg" width="70px"><br>
     
        <h2>SIGN UP</h2>

        <input type="text"placeholder="First name" name="firstname" value="<?php echo $firstname ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['firstname'] ?? '';?>
      </div>

      <input type="text"placeholder="Surname" name="surname" value="<?php echo $surname ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['surname'] ?? '';?>
      </div>

        <input type="text"placeholder="Username" name="username" value="<?php echo $username ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['username'];  ?>
      </div>

       
        <input type="text"placeholder="Email" name="email" value="<?php echo $email ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['email'];  ?>
      </div>

      <div class="pics"><input type="file"id="Choose a picture" name="profilepics" value="<?php echo $profilepics ?? ''; ?>"></div><br><br>
        <div class="error">
          <?php echo $error['profilepics'];  ?>
      </div>


        <input type="password"placeholder="Password" name="password" value="<?php echo $password ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['password']; ?>
      </div>

        <input type="password"placeholder="Confirm password" name="cpassword" value="<?php echo $cpassword ?? ''; ?>"><br><br>
        <div class="error">
          <?php echo $error['cpassword']; ?>
      </div><br><br>

        <button name="submit">Sign up</button><br><br>
        </form>
        <div class="signin">
        <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
        
</body>
</html>
