<?php
require('../includes/database.php');
$id = $_GET['uid'];
$delete_post = mysqli_query($conn, "DELETE FROM tenants WHERE id='$id'");
header("location: tenants.php");