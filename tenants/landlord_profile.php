<?php
session_start();
if(!isset($_SESSION['tenantId']))
{
    header('Location: ../login.php');
}
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
    .wrapper{ width: 250px; padding: 20px; }
    </style>
</head>
<body>
<?php
require("navbar.php");
require("../includes/database.php");


$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

$sql = mysqli_query($conn, "SELECT * FROM tenants WHERE firstname='$firstname' AND lastname='$lastname'");
$row = mysqli_fetch_assoc($sql);

$landlord_firstname = $row['landlord_first'];
$landlord_lastname = $row['landlord_last'];

$sql_landlord = mysqli_query($conn, "SELECT * FROM landlords WHERE firstname='$landlord_firstname' AND lastname='$landlord_lastname'");
$row_landlord = mysqli_fetch_assoc($sql_landlord);
$id = $row_landlord['id'];

$sql_profile = mysqli_query($conn, "SELECT * FROM profileimg WHERE firstname='$landlord_firstname' AND lastname='$landlord_lastname'");
$row_profile = mysqli_fetch_assoc($sql_profile);

$sql_images = mysqli_query($conn, "SELECT * FROM images WHERE firstname='$landlord_firstname' AND lastname='$landlord_lastname'");

$sql_details = mysqli_query($conn, "SELECT * FROM details WHERE firstname='$landlord_firstname' AND lastname='$landlord_lastname'");
$row_details = mysqli_fetch_assoc($sql_details);

echo '<div class="container">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
            ';

if($row_profile['status'] == 0)
{
    echo "<img src='../landlords/uploads/profile".$id.".jpg' class='card-img-top rounded'>";
}
else
{
    echo "<img src='../landlords/uploads/profiledefault.jpg' class='rounded'>";
}

echo '<div class="card-body">';
echo "<div class='card-title'><h1>".$row_landlord['firstname']." ".$row_landlord['lastname']."</h1></div>";
echo $row_details['info'];
echo '<br><br><img src="../imgs/loc.png" width="40px" height="40px"><b>'.$row_landlord['location'].'</b>';
echo '<br><img src="../imgs/house.png" width="40px" height="40px"> <b>'.$row_landlord['housetype'].'</b>';
echo "<br><form method='POST'><input type='submit' name='add_review' value='add review' class='btn btn-outline-primary btn-sm'></form>";
echo "</div></div>";

echo '<div class="col-12 col-md-6 col-lg-4">';

if(isset($_POST['add_review']))
{
    echo "<form method='POST'>
            <b>rate from 0 to 10</b>
            <select name='rating'>
            <option>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select><br>
        ";
    echo '<br><textarea name="text" cols="40" rows="4" placeholder="additional queries"></textarea><br>
            <br><input type="submit" name="submit_review" value="submit" class="btn btn-outline-primary btn-sm"></form>';
}
echo "</div>";
if(isset($_POST['submit_review']))
{
    $info = $_POST['text'];
    $rating = $_POST['rating'];
    if(empty($info))
    {
        $info = "N/A";
    }
    $insert_review = mysqli_query($conn, "INSERT INTO reviews(tenant_firstname, tenant_lastname, landlord_firstname, landlord_lastname, info, rating, date) VALUES('$firstname', '$lastname', '$landlord_firstname', '$landlord_lastname', '$info', '$rating', NOW())");
    echo "<script>alert('sent successfully!')</script>";
}

$reviews_sql = mysqli_query($conn, "SELECT * FROM reviews WHERE landlord_firstname='$landlord_firstname' AND landlord_lastname='$landlord_lastname'");

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

$reviews_sql = mysqli_query($conn, "SELECT * FROM reviews WHERE landlord_firstname='$landlord_firstname' AND landlord_lastname='$landlord_lastname' ORDER BY id ASC LIMIT " . $this_page_first_result . ',' . $results_per_page );

echo '<div class="container">
        <div class="row g-3">
            ';
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
     
    if($_SESSION['firstname']==$row_review['tenant_firstname'] AND $_SESSION['lastname']==$row_review['tenant_lastname'])
    {
        echo "<a href='delete_review.php?id=".$id."' class='btn btn-outline-danger btn-sm'>delete</a>";
    }

    echo '</div>
        </div></div>';
}
echo "<div></div></div>";

echo '<nav aria-label="Page navigation example" class="container">

      <ul class="pagination">';
for($page=1;$page<=$number_of_pages;$page++)
{
    echo '<li class="page-item"><a class="page-link" href="landlord_profile.php?page=' . $page . '" > ' . $page . '</a></li>';
}

echo "</ul></nav>";

echo '<div class="container">
    <h1>Gallery</h1>
    <div class="row g-3">';
    while($row_img = mysqli_fetch_assoc($sql_images))
    {
        echo '<div class="col-12 col-md-6 col-lg-4">';
        echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row_img['image'] ).'"/">';
        echo "</div>";
    }

