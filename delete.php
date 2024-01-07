<?php
require('includes/database.php');
$id = $_GET['id'];
$delete_post = mysqli_query($conn, "DELETE FROM user_notification WHERE id='$id'");
header("location: notifications.php");