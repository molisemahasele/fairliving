<?php
require('../includes/database.php');
$id = $_GET['id'];
$delete_post = mysqli_query($conn, "DELETE FROM contacts WHERE id='$id'");
header("location: contact.php");