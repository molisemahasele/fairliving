<?php
require('../includes/database.php');
$id = $_GET['uid'];
$delete_post = mysqli_query($conn, "DELETE FROM paid_tenants WHERE id='$id'");
header("location: paid_tenants.php");