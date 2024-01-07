<?php

require("../includes/database.php");

$uid = $_GET['uid'];
$sql = mysqli_query($conn, "SELECT * FROM tenants WHERE id='$uid'");
$row = mysqli_fetch_assoc($sql);

$firstname = $row['firstname'];
$lastname = $row['lastname'];
$landlord_firstname = $row['landlord_first'];
$landlord_lastname = $row['landlord_last'];
$payment_confirmed = "payment confirmed!!";

$insert = mysqli_query($conn, "INSERT INTO paid_tenants(firstname, lastname, landlord_first, landlord_last, date) VALUES ('$firstname', '$lastname', '$landlord_firstname', '$landlord_lastname', NOW())");
$notification = mysqli_query($conn, "INSERT INTO messages(tenant_firstname, tenant_lastname, firstname, lastname, info, date) VALUES ('$firstname', '$lastname', '$landlord_firstname', '$landlord_lastname', '$payment_confirmed', NOW())");
$count = mysqli_query($conn, "INSERT INTO notifications(tenant_firstname, tenant_lastname, landlord_firstname, landlord_lastname, info, date) VALUES ('$firstname', '$lastname', '$landlord_firstname', '$landlord_lastname', '$payment_confirmed', NOW())");
header("location: paid_tenants.php");
