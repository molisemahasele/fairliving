<?php
   // session_start();
    //if(!isset($_SESSION['userId']))
    //{
      //  header("location: welcome.php");
    //}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>houses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 400px; padding: 20px; margin-left: 20px;}
    </style>
</head>
<body>
    <?php 
    //require("includes/user_navbar.php");
    require("includes/database.php");

    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];

    $sql = mysqli_query($conn, "SELECT * FROM profileimg WHERE firstname='$firstname' AND lastname='$lastname'");
    $landlords = mysqli_query($conn, "SELECT * FROM landlords WHERE firstname='$firstname' AND lastname='$lastname'");
    $details = mysqli_query($conn, "SELECT * FROM details WHERE firstname='$firstname' AND lastname='$lastname'");
    $postImg = mysqli_query($conn, "SELECT * FROM images WHERE firstname='$firstname' AND lastname='$lastname'");
    $rowImg = mysqli_fetch_assoc($sql);
    $row = mysqli_fetch_assoc($landlords);
    $rowDetails = mysqli_fetch_assoc($details);
    $id = $row['id'];

    echo '<div class="container">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
            ';

    if($rowImg['status'] == 0)
    {
        echo "<img src='landlords/uploads/profile".$id.".jpg' class='card-img-top rounded'>";
    }
    else
    {
        echo "<img src='landlords/uploads/profiledefault.jpg' class='card-img-top rounded'>";
    }

    echo '<div class="card-body">';
    echo "<div class='card-title'><h1>".$row['firstname']." ".$row['lastname']."</h1></div>";
    echo $rowDetails['info'];
    echo '<br><br><img src="imgs/loc.png" width="40px" height="40px"> <b>'.$row['location'].'</b>';
    echo '<br><img src="imgs/house.png" width="40px" height="40px"> <b>'.$row['housetype'].'</b>';
    echo "</div></div></div></div>";

    $reviews_sql = mysqli_query($conn, "SELECT * FROM reviews WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname'");

    $results_per_page = 3;
        
    $number_of_results = mysqli_num_rows($reviews_sql);
        
    $number_of_pages = ceil($number_of_results/$results_per_page);
        
    if(!isset($_GET['page']))
    {
        $page = 1;
    }
    else
    {
        $page=$_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $reviews_sql = mysqli_query($conn, "SELECT * FROM reviews WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname' ORDER BY id ASC LIMIT " . $this_page_first_result . ',' . $results_per_page);

     echo '<div class="container">
        <div class="row g-3">';

    while($row_review = mysqli_fetch_assoc($reviews_sql))
    {
        $id = $row_review['id'];
        echo '<div class="col-12 col-md-6 col-lg-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo "<b>";
        echo $row_review['tenant_firstname'].' '.$row_review['tenant_lastname'];
        echo "</b>";
        echo '<br>rating: <b>'.$row_review['rating'].'</b>';
        echo '<p class="card-text">'.$row_review['info'].'<br>'.$row_review['date'].'</p>';

        echo '</div></div></div>';
    }
    echo "</div></div><br>";

    echo '<nav aria-label="Page navigation example" class="container">

      <ul class="pagination">';
for($page=1;$page<=$number_of_pages;$page++)
{
    echo '<li class="page-item"><a class="page-link" href="profile.php?page=' . $page . '&firstname='.$firstname.'&lastname='.$lastname.'" > ' . $page . '</a></li>';
}

echo "</ul></nav>";
    
    echo '<div class="container">
        <h1>Gallery</h1>
        <div class="row g-3">';
    while($rowPosts = mysqli_fetch_assoc($postImg))
    {
        echo '<div class="col-12 col-md-6 col-lg-4">';
        echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $rowPosts['image'] ).'"/">';
        echo "</div>";
    }