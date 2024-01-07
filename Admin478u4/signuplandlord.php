<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}
?>

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
    <?php require("navbar.php"); ?>
    <form method="POST" class="container">
    	<input type="text" name="firstname" placeholder="firstname" class="form-control"><br>
    	<input type="text" name="lastname" placeholder="lastname" class="form-control"><br>
    	<input type="password" name="password" placeholder="password" class="form-control"><br>
    	<input type="text" name="location" placeholder="location" class="form-control"><br>
    	<input type="text" name="housetype" placeholder="housetype" class="form-control"><br>
    	<input type="submit" name="submit" value="submit" class="btn btn-outline-danger">
    </form>

    <?php

    	require("../includes/database.php");

    	if(isset($_POST['submit']))
    	{
    		$firstname = $_POST['firstname'];
    		$lastname = $_POST['lastname'];
    		$password = $_POST['password'];
    		$location = $_POST['location'];
    		$housetype = $_POST['housetype'];

    		$check = mysqli_query($conn, "SELECT * FROM landlords");

 			while($result = mysqli_fetch_assoc($check))
 			{
 				if($result['firstname'] == $firstname && $result['lastname'] == $lastname)
 				{
 					echo "<script>window.alert('names already exist!')</script>";
 					exit();
 				}
 			}

 			if(empty($firstname) || empty($lastname) || empty($location) || empty($password) || empty($housetype))
 			{
 				echo "<script>window.alert('fill in all fields!!')</script>";
 				exit();
 			}
 			$hashed_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
 			$insert = mysqli_query($conn, "INSERT INTO landlords(firstname, lastname, location, housetype, password) VALUES('$firstname', '$lastname', '$location', '$housetype', '$hashed_password')");
            $insert_profile = mysqli_query($conn, "INSERT INTO profileimg(firstname, lastname, status) VALUES('$firstname', '$lastname', 1)");
 			echo "<script>window.alert('registered succesfully')</script>";
 			
    	}
    ?>
</body>
</html>