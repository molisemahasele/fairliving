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
    <link rel="stylesheet" type="text/css" href="css/inboxStyle.css">
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
$id = $_SESSION['tenantId'];

$Landlord = mysqli_query($conn, "SELECT * FROM tenants WHERE firstname='$firstname' AND lastname='$lastname'");
$row_landlord = mysqli_fetch_assoc($Landlord);
$landlord_first = $row_landlord['landlord_first'];
$landlord_last = $row_landlord['landlord_last'];

$profile = mysqli_query($conn, "SELECT * FROM tenantsprofileimg WHERE firstname='$firstname' AND lastname='$lastname'");
$row_profile = mysqli_fetch_assoc($profile);

$details = mysqli_query($conn, "SELECT * FROM tenant_details WHERE firstname='$firstname' AND lastname='$lastname'");
$row_details = mysqli_fetch_assoc($details);

echo '<div class="container">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
            ';

if($row_profile['status'] == 0)
{
    echo "<img src='uploads/profile".$id.".jpg' class='card-img-top rounded'>";
}
else
{
    echo "<img src='uploads/profiledefault.jpg' class='card-img-top rounded'>";
}

echo '<div class="card-body">';
echo "<div class='card-title'><h1>".$row_details['firstname']." ".$row_details['lastname']."</h1></div>";
echo '<br><br><img src="../imgs/loc.png" width="40px" height="40px"> <b>'.$row_details['location'].'</b>';
echo '<br><br><img src="../imgs/call.jpg" width="40px" height="40px"> <b>'.$row_details['phone'].'</b>';
echo '<br><br><img src="../imgs/house.png" width="40px" height="40px"> <b>'.$row_details['houseType'].'</b>';
echo '<br><br><img src="../imgs/m.jpg" width="40px" height="40px"> <b>'.$row_details['marital_status'].'</b>';
echo '<br><br><img src="../imgs/emp.png" width="40px" height="40px"> <b>'.$row_details['employement'].'</b>';
echo '<br><br><img src="../imgs/sex.png" width="40px" height="40px"> <b>'.$row_details['gender'].'</b>';
echo '<br><br><img src="../imgs/birth.png" width="40px" height="40px"> <b>'.$row_details['dateofbirth'].'</b>';
echo '<br><br><img src="../imgs/cal.png" width="40px" height="40px"> <b>'.$row_details['arrivalDate'].'</b>';
echo "</div></div>";

echo "<div class='col-12 col-md-6 col-lg-4'>
        <form class='form-control container' action='upload.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='file' class='form-control'><br>
        <button type='submit' name='submit' class='btn btn-outline-primary'>upload</button>
        </form><br>";

echo "<form method='POST'>
        <input type='text' placeholder='location' name='location' class='form-control'><br>
        <input type='text' placeholder='room number' name='roomNo' class='form-control'><br>
        <input type='text' placeholder='house type' name='houseType' class='form-control'><br>
        <input type='text' placeholder='marital status' name='marital' class='form-control'><br>
        <input type='text' placeholder='employement' name='employement' class='form-control'><br>
        <input type='tel' placeholder='phone' name='phone' class='form-control'><br>
        <b>date of birth</b>
        <input type='date' placeholder='dateofbirth' name='dateofbirth' class='form-control'><br>
        <b>arrival date</b>
        <input type='date' name='dateofarrival' class='form-control'><br>
         <select name='gender' class='form-control'>
            <option>male</option>
            <option>female</option>
        </select><br>
        <input type='submit' name='insert' value='submit' class='btn btn-outline-primary'>";

if(isset($_POST['insert']))
{
    $location = $_POST['location'];
    $roomNo = $_POST['roomNo'];
    $houseType = $_POST['houseType'];
    $marital = $_POST['marital'];
    $employement = $_POST['employement'];
    $dateofbirth = $_POST['dateofbirth'];
    $dateofarrival = $_POST['dateofarrival'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    if(empty($location) || empty($roomNo) || empty($houseType) || empty($marital) || empty($employement) || empty($dateofbirth) || empty($gender))
    {
        echo "<script>alert('fill in all the details')</script>";
        exit();
    }

    $details_rows = mysqli_num_rows($details);
    if($details_rows == 0)
    {
        $insert = mysqli_query($conn, "INSERT INTO tenant_details(firstname,lastname,dateofbirth,landlord_first,landlord_last,marital_status,roomNo,gender,employement,location,houseType, arrivalDate, phone) VALUES('$firstname', '$lastname', '$dateofbirth', '$landlord_first', '$landlord_last', '$marital', '$roomNo', '$gender', 'employement', '$location', '$houseType', '$dateofarrival', '$phone')");
        echo "<script>alert('successful')</script>";
    }
    elseif($details_rows == 1)
    {
        $edit = mysqli_query($conn, "UPDATE tenant_details SET firstname='$firstname', lastname='$lastname', location='$location', roomNo='$roomNo', houseType='$houseType', marital_status='$marital', employement='$employement', dateofbirth='$dateofbirth', gender='$gender', arrivalDate='$dateofarrival', phone='$phone' WHERE firstname='$firstname' AND lastname='$lastname'");
        echo "<script>alert('successful')</script>";
    }
}
