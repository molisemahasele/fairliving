<?php
session_start();
if(!isset($_SESSION['adminId']))
{
    header('Location: ../login.php');
}
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
<?php require("navbar.php") ?>
    <h1>Send a message to all tenants</h1>
    <form action="" method="post" enctype="multipart/form-data" class="wrapper">
        <textarea name="text" cols="40" rows="4" class="form-control" placeholder="message"></textarea><br>
        <input type="submit" name="submit" value="submit" class="btn btn-outline-primary">
    </form>
</body>
<hr/>
</html>
<?php 
if(isset($_POST['submit'])){ 
    // Include the database configuration file 
    include ("../includes/database.php"); 
    $str = uniqid('', true);
    $firstname = htmlspecialchars($_SESSION['firstname']);
    $lastname = htmlspecialchars($_SESSION['lastname']);

    $sql = mysqli_query($conn, "SELECT * FROM tenants WHERE landlord_last = '$lastname' AND landlord_first='$firstname'");

    $text = $_POST['text'];
    if(empty($text))
    {
        echo "<script>window.alert('fill in all fields')</script>";
        exit();
    }
    else
    {
        while($row = mysqli_fetch_assoc($sql))
        {
            $tenant_firstname = $row['firstname'];
            $tenant_lastname = $row['lastname'];

            $upload = mysqli_query($conn, "INSERT INTO messages(tenant_firstname, tenant_lastname, firstname, lastname, date, info) VALUES('$tenant_firstname', '$tenant_lastname', '$firstname', '$lastname', NOW(), '$text')");
            $notification = mysqli_query($conn, "INSERT INTO notifications(tenant_firstname, tenant_lastname, landlord_firstname, landlord_lastname, date, info) VALUES ('$tenant_firstname', '$tenant_lastname', '$firstname', '$lastname', NOW(), '$text')");

        }

        
    }
    echo "<script>window.alert('Success!')</script>";
}  
?> 