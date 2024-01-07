<?php
session_start();
if(!isset($_SESSION['adminId']))
{
    header('Location: ../login.php');
}

require("../includes/database.php");
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
    <?php require("navbar.php");
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];

    $details = mysqli_query($conn, "SELECT * FROM tenant_details WHERE firstname='$firstname' AND lastname='$lastname'");
    $row_details = mysqli_fetch_assoc($details);

    $profile = mysqli_query($conn, "SELECT * FROM tenantsprofileimg WHERE firstname='$firstname' AND lastname='$lastname'");
    $row_profile = mysqli_fetch_assoc($profile);

    $tenants = mysqli_query($conn, "SELECT * FROM tenants WHERE firstname='$firstname' AND lastname='$lastname'");
    $tenants_row = mysqli_fetch_assoc($tenants);
    $id = $tenants_row['id'];

    echo '<div class="container">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
            ';

    if($row_profile['status'] == 0)
    {
        echo "<img src='../tenants/uploads/profile".$id.".jpg' class='card-img-top rounded'>";
    }
    else
    {
        echo "<img src='../tenants/uploads/profiledefault.jpg' class='card-img-top rounded'>";
    }

    echo '<div class="card-body">';
    echo "<div class='card-title'><h1>".$row_details['firstname']." ".$row_details['lastname']."</h1></div>";
    echo '<img src="../imgs/loc.png" width="40px" height="40px"> <b>'.$row_details['location'].'</b>';
    echo '<br><br><img src="../imgs/call.jpg" width="40px" height="40px"> <b>'.$row_details['phone'].'</b>';
    echo '<br><br><img src="../imgs/house.png" width="40px" height="40px"> <b>'.$row_details['houseType'].'</b>';
    echo '<br><br><img src="../imgs/m.jpg" width="40px" height="40px"> <b>'.$row_details['marital_status'].'</b>';
    echo '<br><br><img src="../imgs/emp.png" width="40px" height="40px"> <b>'.$row_details['employement'].'</b>';
    echo '<br><br><img src="../imgs/sex.png" width="40px" height="40px"> <b>'.$row_details['gender'].'</b>';
    echo '<br><br><img src="../imgs/birth.png" width="40px" height="40px"> <b>'.$row_details['dateofbirth'].'</b>';
    echo '<br><br><img src="../imgs/cal.png" width="40px" height="40px"> <b>'.$row_details['arrivalDate'].'</b>';
    echo '<br><br>roomNo: <b>'.$row_details['roomNo'].'</b>';
    echo "</div></div>";

    ?>