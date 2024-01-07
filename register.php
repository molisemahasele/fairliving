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
    <?php require("includes/navbar.php"); ?>
    <form method="POST" class="container">
    	<input type="text" name="firstname" placeholder="firstname" class="form-control"><br>
    	<input type="text" name="lastname" placeholder="lastname" class="form-control"><br>
    	<input type="password" name="password" placeholder="password" class="form-control"><br>
        <input type="password" name="confirm_password" placeholder="confirm password" class="form-control"><br>
    	<input type="email" name="email" placeholder="email" class="form-control"><br>
    	<input type="submit" name="submit" value="submit" class="btn btn-outline-danger">
    </form>

    <?php

    	require("includes/database.php");

    	if(isset($_POST['submit']))
    	{
    		$firstname = $_POST['firstname'];
    		$lastname = $_POST['lastname'];
    		$password = $_POST['password'];
    		$confirm_password = $_POST['confirm_password'];
    		$email = $_POST['email'];
            $vkey = md5(time().$firstname);

    		$check = mysqli_query($conn, "SELECT * FROM users");

 			while($result = mysqli_fetch_assoc($check))
 			{
 				if($result['firtname'] == $firstname && $result['lastname'] == $lastname)
 				{
 					echo "<script>window.alert('names already exist!')</script>";
 					exit();
 				}
 			}

 			if(empty($firstname) || empty($lastname) || empty($confirm_password) || empty($password))
 			{
 				echo "<script>window.alert('fill in all fields!!')</script>";
 				exit();
 			}
            if($password != $confirm_password)
            {
                echo "<script>window.alert('passwords don\'t match!!')</script>";
                exit();
            }
 			$hashed_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
 			$insert = mysqli_query($conn, "INSERT INTO users(firtname, lastname, email, password, vkey, verified) VALUES('$firstname', '$lastname', '$email', '$hashed_password', '$vkey', 0)");
            
 			echo "<script>window.alert('registered succesfully')</script>";
 			
    	}
    ?>
</body>
</html>