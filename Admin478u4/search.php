<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}
require("../includes/database.php");
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

require("navbar.php");



if(isset($_POST['submit-search']))
{
	$search = $_POST['search'];
	$sql = mysqli_query($conn, "SELECT * FROM posts WHERE location LIKE '%$search%' OR id LIKE '%$search%' OR houseType LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR info LIKE '%$search%'");
	$querySql = mysqli_num_rows($sql);

	
	if($querySql > 0)
	{
        echo '<div class="container">';
        echo "<b>There are ". $querySql. " results!</b><br><br>";
        echo '<div class="row g-3">';
		while($row = mysqli_fetch_assoc($sql))
		{

			$firstname = $row['firstname'];
    		$lastname = $row['lastname'];
    		$unique = $row['uniqueid'];
    		$select2 = mysqli_query($conn, "SELECT * FROM images WHERE uniqueid='$unique'");
    		$row2 = mysqli_fetch_assoc($select2);

			echo '
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">';
                    echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/">';
                    echo '<details><summary>click to see more/less</summary>';
                    while ($row2 = mysqli_fetch_assoc($select2)) 
                    {
                        echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/"><br>';
                    }
                    echo '</details>';
                    echo '<div class="card-body">
                        <h5 class="card-title">'.$row['location'].'</h5>
                        <p class="card-text"><b>'.$row['houseType'].'</b><br>'.$row['info'].'<br>'.$row['date'].'</p>
                    </div>
                </div>
            </div>';
		}
	}
	else
	{
		echo "<b>There are no matching results!</b>";
	}
}