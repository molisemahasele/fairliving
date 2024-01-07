<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}
require("../includes/database.php");
$landlords = mysqli_query($conn, "SELECT * FROM landlords");
$landlords2 = mysqli_query($conn, "SELECT * FROM landlords");
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
    
    </style>
</head>
<body>
<?php require("navbar.php");?>
    <div align="center">
    </div><br>
    <form action="" method="post" enctype="multipart/form-data" class="container wrapper">
        <!--<input type="text" name="firstname" placeholder="firstname" class="form-control"><br>
        <input type="text" name="lastname" placeholder="lastname" class="form-control"><br>-->
        <b>landlord firstname</b>
        <select name="landlord_first" class="form-control">
                <?php
                while($row = mysqli_fetch_assoc($landlords))
                {
                    echo "<option>".$row['firstname']."</option>";
                }
                ?>
        </select><br>
        <b>landlord lastname</b>
        <select name="landlord_last" class="form-control">
                <?php
                while($row2 = mysqli_fetch_assoc($landlords2))
                {
                    echo "<option>".$row2['lastname']."</option>";
                }
                ?>
        </select><br>
        <input type="text" name="firstname" placeholder="firstname" class="form-control"><br>
        <input type="text" name="lastname" placeholder="lastname" class="form-control"><br>
        <input type="password" name="password" placeholder="password" class="form-control"><br>
        <input type="submit" name="submit" value="submit" class="btn btn-outline-danger">
    </form>
</body>
<hr/>
</html>
<?php 
if(isset($_POST['submit'])){ 
    $str = uniqid('', true);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $landlord_last = $_POST['landlord_last'];
    $landlord_first = $_POST['landlord_first'];
    $password = $_POST['password'];

    if(empty($lastname) || empty($firstname) || empty($landlord_first) || empty($landlord_last) || empty($password))
    {
        echo "<script>window.alert('fill in all fields')</script>";
        exit();
    }
    else
    {
        $sql = mysqli_query($conn, "SELECT * FROM landlords where firstname = '$landlord_first' AND lastname = '$landlord_last'");

        if(mysqli_num_rows($sql) == 0)
        {
            echo "<script>window.alert('landlord not available!')</script>";
            exit();
        }

        $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
        $upload = mysqli_query($conn, "INSERT INTO tenants(firstname, lastname, landlord_first, landlord_last, password, date) VALUES('$firstname', '$lastname', '$landlord_first', '$landlord_last', '$hash_password', NOW())");
        $insert = mysqli_query($conn, "INSERT INTO tenantsprofileimg(firstname, lastname, status) VALUES('$firstname', '$lastname', 1)");
    }
    echo "<script>window.alert('Success!')</script>";
}  
?>