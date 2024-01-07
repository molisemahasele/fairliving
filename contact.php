<?php
   // session_start();
   // if(!isset($_SESSION['userId']))
    //{
      //  header("location: welcome.php");
    //}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>FairLiving</title>
  </head>
  <body>


<?php
//require("includes/user_navbar.php");
require("includes/database.php");
require("includes/navbar.php");

$landlord_first = $_GET['firstname'];
$landlord_last = $_GET['lastname'];
$id = $_GET['id'];
//$userId = $_SESSION['userId'];
?>
<div class="container">
  <h1>Contact</h1>
  <p><a href="tel:+26657773922" style="text-decoration:none"><img src="imgs/call.jpg" width="40px" height="40px"> +2665777392 </a></p>
  <p><a href="https://wa.me/2665777922" style="text-decoration:none"><img src="imgs/App.png" width="40px" height="40px"> +2665777392</a></p>
<form class="wrapper" id="contact" method="POST">
<div class="mb-3">
  <label class="form-label">Fullname</label>
  <input type="text" class="form-control" name='fullname' placeholder="names...">
</div>
<div class="mb-3">
  <label class="form-label">Phone number</label>
  <input type="number" class="form-control" name='phone' placeholder="phone number">
</div>
<div class="mb-3">
  <label class="form-label">E-mail</label>
  <input type="email" class="form-control" name='email' placeholder="E-mail">
</div>
<div class="mb-3">
  <label class="form-label">Message</label>
  <textarea class="form-control" name='message' placeholder="message and contact details" rows="3"></textarea>
</div>
<input type="submit" name="submit" value='send' class='btn btn-primary' class="form-control">
</form>
</div>
<hr>

<?php

if(isset($_POST['submit']))
{
  $fullname = $_POST['fullname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
	$info = $_POST['message'];
	if(empty($fullname) || empty($info))
	{
		echo "<script>alert('fill in all the info!')</script>";
		exit();
	}
	$insert = mysqli_query($conn, "INSERT INTO contacts(fullname, landlord_first, landlord_last, info, date, postid, phone, email) VALUES ('$fullname', '$landlord_first', '$landlord_last', '$info', NOW(), '$id', '$phone', '$email')");
	echo "<script>alert('sent successfully!')</script>";

}