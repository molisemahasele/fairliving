<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>fairliving</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <form method="POST">
    	<input type="text" name="firstname" placeholder="firstname"><br>
    	<input type="text" name="lastname" placeholder="lastname"><br>
    	<input type="password" name="password" placeholder="password"><br>
    	<input type="submit" name="submit" value="submit">
    </form>

    <?php

    	require("../includes/database.php");

    	if(isset($_POST['submit']))
    	{
    		$firstname = $_POST['firstname'];
    		$lastname = $_POST['lastname'];
    		$password = $_POST['password'];

    		$check = mysqli_query($conn, "SELECT * FROM admin");

 			while($result = mysqli_fetch_assoc($check))
 			{
 				if($result['firstname'] == $firstname && $result['lastname'] == $lastname)
 				{
 					echo "<script>window.alert('names already exist!')</script>";
 					exit();
 				}
 			}

 			if(empty($firstname) || empty($lastname) || empty($password))
 			{
 				echo "<script>window.alert('fill in all fields!!')</script>";
 				exit();
 			}
 			$hashed_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
 			$insert = mysqli_query($conn, "INSERT INTO admin(firstname, lastname, password) VALUES('$firstname', '$lastname', '$hashed_password')");
 			echo "<script>window.alert('registered succesfully')</script>";
 			
    	}
    ?>
</body>
</html>