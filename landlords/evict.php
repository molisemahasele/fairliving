<?php
session_start();
if(!isset($_SESSION['adminId']))
{
    header('Location: ../login.php');
}

require("../includes/database.php");


$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

$tenant_firstname = $_GET['firstname'];
$tenant_lastname = $_GET['lastname'];

$info = "You will be evicted soon!";

$insert = mysqli_query($conn, "INSERT INTO messages(tenant_firstname, tenant_lastname, firstname, lastname, info, date) VALUES('$tenant_firstname', '$tenant_lastname', '$firstname', '$lastname', '$info', NOW())");
$notification = mysqli_query($conn, "INSERT INTO notifications(tenant_firstname, tenant_lastname, landlord_firstname, landlord_lastname, info, date) VALUES ('$tenant_firstname', '$tenant_lastname', '$firstname', '$lastname', '$info', NOW())");
header("Location: tenants.php");