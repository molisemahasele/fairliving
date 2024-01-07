<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header('Location: welcome.php');
}

require("includes/database.php");
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
    <?php
    require("includes/user_navbar.php");
    ?>
    <form class="container" method="POST">
        <textarea name="msg" class="form-control" placeholder="request to be landlord"></textarea><br>
        <input type="submit" name="submit" value="submit" class="btn btn-outline-primary">
    </form>

    <?php 
    if(isset($_POST['submit']))
    {
        $msg = $_POST['msg'];
        $userId = $_SESSION['userId'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];

        if(empty($msg))
        {
            echo "<script>alert('insert message!')</script>";
            exit();
        }

        $insert = mysqli_query($conn, "INSERT INTO request(info, uid, firstname, lastname, date) VALUES('$msg', '$userId', '$firstname', '$lastname', NOW())");
        echo "<script>alert('message sent successfully!')</script>";
    }