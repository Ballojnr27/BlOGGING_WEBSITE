<?php

include('db_connect.php');



session_start();
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$surname = $_SESSION['surname'];



   //  write query for all designs
  $sql = "SELECT  username, tittle, content, created_at, id FROM content WHERE username = '$username'";

  // make query & get result
  $result = mysqli_query($conn, $sql);

  
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
   }


  // fetch the resulting rows as an array
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(empty($users)){
    $no_blog = "You do not have any blog.";
      
  }
  

  // free result from memory
  mysqli_free_result($result);


   if(isset($_POST['delete']))
{
   $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
   
   $sql = "DELETE FROM content WHERE id = $id_to_delete";
   
   if(mysqli_query($conn, $sql))
   {
       // success
       header('Location: my_blogs.php');
   } 
   else
   {
       echo 'query error: ' . mysqli_error($conn);
   }
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
    body {
	padding: 0;
	font: 15px/1.5 Arial, Helvetica, sans-serif;

    margin: 0 auto;
    background-color: hsla(139, 61%, 63%, 0.248);
    text-align:center ;
    min-height:400px;
		}

	
		.sidebar {
			height: 100vh;
			width: 200px;
			background-color: hsla(139, 61%, 63%, 0.248);
			position: fixed;
			top: 0;
			left: 0;
			color: #fff;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			transform: translateX(-100%);
			transition: transform 0.3s ease-in-out;
		}
		.sidebar.show {
			transform: translateX(0%);
		}
		.sidebar ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}
		.sidebar ul li {
			padding: 10px;
			text-align: center;
			cursor: pointer;
			transition: all 0.3s ease;
            color:black;
		}
		.sidebar ul li:hover {
			color: hsla(139, 61%, 63%, 0.248);
		}
		.content {
			margin-left: 200px;
			padding: 20px;
		}
		.toggle-button {
			display: block;
			position: fixed;
			top: 20px;
			left: 20px;
			width: 40px;
			height: 40px;
			background-color: #333;
			border: none;
			border-radius: 50%;
			cursor: pointer;
			color: #fff;
			font-size: 24px;
			text-align: center;
			line-height: 40px;
			z-index: 9999;
		}

		.submit{
    width:150px;
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

        .here{
            color:black ;
        }
		

	</style>

</head>
<body>
    


	<div class="sidebar">
		<ul>
		
		<li> <a href="dashboard.php">Home</a></li>
		<li> <a href="profile.php">My Profile</a></li>		
		<li> <a href="blog_creation.php">Create Blog</a></li>
		<li> <a href="blog_feed.php">Blog Feed</a></li>
        <li> <a href="my_blogs.php" class="here">My Blogs</a></li>
        <li> <a href="index.php">Log Out</a></li>

        
		</ul>
	</div>
	<div class="content">
        
		
       <h2>My Blogs</h2>

	   <?php echo $no_blog ?? ''; ?><br<br>

	   
	<?php foreach($users as $user): ?>

		<?php echo $firstname; ?> <?php echo $surname; ?></b> <br>
		<a href="profile.php"> @ <?php echo $username;  ?> </a><br>


    <div class="user">		
	<?php echo $user['created_at']; ?>
		<br><h3><b>
			Title: 
		</b><?php echo $user['tittle']; ?></h3>
		<i><?php echo $user['content']; ?></i><br>
		
	</div>
    <br>

	   <form action='my_blogs.php' method='POST'>
            <input type="hidden" name="id_to_delete" value="<?php echo $user['id']; ?>">
           
            <button name="delete" class="submit">Delete Blog</button>      
       </form><br>

		  <?php endforeach; ?>

		  


	
    </div>
	<button class="toggle-button">&#9776;</button>
	<script>
		const toggleButton = document.querySelector('.toggle-button');
		const sidebar = document.querySelector('.sidebar');

		toggleButton.addEventListener('click', () => {
			sidebar.classList.toggle('show');
		});
	</script>


</body>
</html>