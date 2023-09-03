<?php

session_start();
$username = $_SESSION['username'];


require('db_connect.php');

$error = array('title'=>'', 'content'=>'');

if(isset($_POST['submit'])){
    $title = ($_POST['title']);
    $content = ($_POST['content']);

    // check title
    if(empty($title)){
        $error['title'] = 'title cannot be empty';
    } 
    
    //check content
    if(empty($content)){
        $error['content'] = 'content cannot be empty';
    } 
    
    if(!array_filter($error)){

       // create sql
            $sql = "INSERT INTO content(username, tittle, content) VALUES('$username',  '$title', '$content')";
        
                if(mysqli_query($conn, $sql))
            {
                // connected
               header('Location: my_blogs.php');
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
        .here{
            color:black ;
        }

        .error{
            color: coral;
        }
		

	</style>

</head>
<body>
    


	<div class="sidebar">
		<ul>
		
		<li> <a href="dashboard.php">Home</a></li>
		<li> <a href="profile.php">My Profile</a></li>		
		<li> <a href="blog_creation.php" class="here">Create Blog</a></li>
		<li> <a href="blog_feed.php">Blog Feed</a></li>
        <li> <a href="my_blogs.php" >My Blogs</a></li>
        <li> <a href="index.php">Log Out</a></li>

        
		</ul>
	</div>

	<div class="content">
        
		
	<center>
            <form action="blog_creation.php" method="POST">
        <h2>Create Blog</h2>
  <h4>Tittle of Blog:<h4> 
  <input type="text" name="title"><br>
  <div class="error">
    <?php echo $error['title']; ?>
</div><br>


<h4>Content:<h4>
<textarea rows="10" cols="40" name="content"></textarea><br>
<div class="error">
    <?php echo $error['content']; ?>
</div>
<br>
<button name="submit" class="submit"> Create Blog</button>
<form>
	</center> 

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