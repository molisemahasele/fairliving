<?php
session_start();
require("../includes/database.php");
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$id = $_SESSION['id'];

if(isset($_POST['submit']))
{
	$file = $_FILES['file'];

	$filename = $_FILES['file']['name'];
	$fileTmp = $_FILES['file']['tmp_name'];
	$fileType = $_FILES['file']['type'];
	$fileSize = $_FILES['file']['size'];
	$fileErr = $_FILES['file']['error'];

	$fileExt = explode('.', $filename);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'pdf', 'mp4');

	if(in_array($fileActualExt, $allowed))
	{
		if($fileErr === 0)
		{
			if($fileSize < 10000000000)
			{
				$filenameNew  = "profile".$id.".".$fileActualExt;
				$fileDestination = 'uploads/'.$filenameNew;
				move_uploaded_file($fileTmp, $fileDestination);
				$sql = "UPDATE profileimg SET status=0 WHERE firstname='$firstname' AND lastname='$lastname';";
				$result = mysqli_query($conn, $sql);
				header("location: profile.php?uploadsuccess");
			}
			else
			{
				echo "File too big";
			}
		}
		else
		{
			echo "there was an error";
		}
	}
	else
	{
		echo "You cannot upload files of this type";
	}

}