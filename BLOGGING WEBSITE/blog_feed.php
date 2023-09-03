<?php

include('db_connect.php');

   //  write query for all designs
  $sql = "SELECT  username, tittle, content, created_at, id FROM content ORDER BY created_at";

  // make query & get result
  $result = mysqli_query($conn, $sql);

  
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
   }


  // fetch the resulting rows as an array
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(empty($users)){
    $no_blog = "No Blog Available.";
      
  }
  

  // free result from memory
  mysqli_free_result($result);


   
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
        <li> <a href="blog_feed.php" class="here">Blog Feed</a></li>
        <li> <a href="my_blogs.php">My Blogs</a></li>
        <li> <a href="index.php">Log Out</a></li>

        
		</ul>
	</div>
	<div class="content">
        
		
       <h2>Blog Feed</h2>

	   <?php echo $no_blog ?? ''; ?><br<br>

	   
	<?php foreach($users as $user): ?>
    <div class="user">		
     <b><?php echo $user['username'];  ?></b><br>
	<?php echo $user['created_at']; ?>
		<br><h3><b>
			Title: 
		</b><?php echo $user['tittle']; ?></h3>
		<i><?php echo $user['content']; ?></i><br><br>
		
	</div>
    <br>
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
