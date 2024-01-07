<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}

require("../includes/database.php");
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
    require("navbar.php");
    $userId = $_GET['id'];
    ?>
    <form class="container" method="POST">
        <textarea name="msg" class="form-control" placeholder="reply"></textarea><br>
        <input type="submit" name="submit" value="submit" class="btn btn-outline-primary">
    </form>

    <?php 
    if(isset($_POST['submit']))
    {
        $msg = $_POST['msg'];

        if(empty($msg))
        {
            echo "<script>alert('insert message!')</script>";
            exit();
        }

        $insert = mysqli_query($conn, "INSERT INTO user_notification(messsage, date, userId) VALUES('$msg', NOW(), '$userId')");
        $insert2 = mysqli_query($conn, "INSERT INTO user_notification_count(message, date, userId) VALUES('$msg', NOW(), '$userId')");
        echo "<script>alert('message sent successfully!')</script>";
    }