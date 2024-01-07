<?php
require('../includes/database.php');
$id = $_GET['uid'];
$landlords = mysqli_query($conn, "SELECT * FROM landlords WHERE id='$id'");
$row_landlord = mysqli_fetch_assoc($landlords);
$firstname = $row_landlord['firstname'];
$lastname = $row_landlord['lastname'];

$delete_post = mysqli_query($conn, "DELETE FROM posts WHERE firstname='$firstname' AND lastname='$lastname'");
$delete_tenant_details = mysqli_query($conn, "DELETE FROM tenant_details WHERE landlord_first='$firstname' AND landlord_last='$lastname'");
$delete_tenants = mysqli_query($conn, "DELETE FROM tenants WHERE landlord_first='$firstname' AND landlord_last='$lastname'");
$delete_reviews = mysqli_query($conn, "DELETE FROM reviews WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname'");
$delete_paid_tenants = mysqli_query($conn, "DELETE FROM paid_tenants WHERE landlord_first='$firstname' AND landlord_last='$lastname'");
$delete_messages= mysqli_query($conn, "DELETE FROM messages WHERE firstname='$firstname' AND lastname='$lastname'");
$delete_msg = mysqli_query($conn, "DELETE FROM landlords_msg WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname'");
$delete_tenants = mysqli_query($conn, "DELETE FROM landlords WHERE firstname='$firstname' AND lastname='$lastname'");
$delete_images = mysqli_query($conn, "DELETE FROM images WHERE firstname='$firstname' AND lastname='$lastname'");
$delete_details = mysqli_query($conn, "DELETE FROM details WHERE firstname='$firstname' AND lastname='$lastname'");
$delete_contact = mysqli_query($conn, "DELETE FROM contacts WHERE landlord_first='$firstname' AND landlord_last='$lastname'");
header("location: landlords.php");