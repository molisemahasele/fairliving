<?php
session_start();
if(!isset($_SESSION['tenantId']))
{
    header('Location: login.php');
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
<?php
require("navbar.php");
?>
    <form action="" method="post" enctype="multipart/form-data" class="wrapper">
        <b>change password</p>
        <input type="password" name="password" placeholder="password" class="form-control"><br>
        <input type="password" name="confirm_password" placeholder="confirm password" class="form-control"><br>
        <input type="submit" name="submit" value="submit" class="btn btn-danger" style="padding:3px;">
    </form>
</body>
<hr/>
</html>

<?php
require("../includes/database.php");

if(isset($_POST['submit']))
{
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        echo "<script>window.alert('passwords dont match')</script>";
        exit();
    }
    else
    {
        $tenant_id = $_SESSION['tenantId'];
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $statement = mysqli_query($conn, "UPDATE tenants SET password='$pass' WHERE id='$tenant_id'");
        echo "<script>window.alert('successful')</script>";
    }
}
?>