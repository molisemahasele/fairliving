<?php
session_start();

require('../includes/database.php');

if(isset($_SESSION['adminId']))
{
    require('navbar.php');
    $adminId = $_SESSION['adminId'] ;
    $sql = mysqli_query($conn, "SELECT * FROM landlords WHERE id='$adminId'");
    $row = mysqli_fetch_assoc($sql);
    if($adminId == $row['id'])
    {
        echo "<form class='form-control container wrapper' action='upload.php' method='POST' enctype='multipart/form-data'>
                <input type='file' name='file'>
                <button type='submit' name='submit'>upload</button>
                </form>";
    }
}