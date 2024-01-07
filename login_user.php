<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>fairliving</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 250px; padding: 20px; }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   <?php require("includes/navbar3.php");?>
    <form method="POST" class="wrapper">
    	<input type="text" name="firstname" placeholder="firstname" class="form-control"><br>
    	<input type="text" name="lastname" placeholder="lastname" class="form-control"><br>
    	<input type="password" name="password" placeholder="password" class="form-control"><br>
    	<input type="submit" name="submit" value="submit" class="btn btn-outline-danger">
    </form>

    <?php 
require("includes/database.php");
if(isset($_POST['submit']))
{
    
    $first =  $_POST['firstname'];
    $last = $_POST['lastname'];
    $password = $_POST['password'];

    if(empty($first) || empty($last) || empty($password))
    {
        echo "<script>window.alert('fill in all fields')</script>";
        exit();
    }
    else
        {
            
            $results = mysqli_query($conn,"SELECT * FROM users WHERE firtname='$first' AND lastname='$last'");

            if(mysqli_num_rows($results) > 0)
            {
                if($row = mysqli_fetch_assoc($results))
                {
                    $passwordChecker = password_verify($password, $row['password']);
                    if($passwordChecker == false)
                    {
                        echo "<script>window.alert('wrong password or username')</script>";
                        exit();
                    }
                    else
                    {
                        $str = uniqid('', true);
                        session_start();
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['firstname'] = $row['firtname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        header("location: index.php");
                    }
                }
            }
            else
            {
                echo "<script>window.alert('wrong password or username')</script>";
                exit();
            }

        }
}