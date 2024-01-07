<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}

require("../includes/database.php");
$landlords = mysqli_query($conn, "SELECT * FROM landlords");
$landlord = mysqli_query($conn, "SELECT * FROM landlords");

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
    <?php require("navbar.php"); ?>
    <div align="center">
    </div><br>
    <form action="" method="post" enctype="multipart/form-data" class="wrapper">
        Select Images Files to Upload:
       <input type="file" name="img[]" multiple="multiple" class="form-control"><br>
        <textarea name="text" cols="40" rows="4" placeholder="contact info and additional info"></textarea><br>
        <!--<select name="location" class="form-control">
            <option>Thetsane</option>
            <option>Ha-Pita</option>
            <option>Abia</option>
        </select>-->
        <input type="text" name="location" class="form-control" placeholder="location">
        <br>
        <b>landlord firstname</b>
        <select name="firstname" class="form-control">
            <?php while($row_firstname = mysqli_fetch_assoc($landlords)) 
                  {
                    echo "<option>".$row_firstname['firstname']."</option>";
                  }
            ?>
        </select><br>
        <b>landlord lastname</b>
        <select name="lastname" class="form-control">
            <?php while($row = mysqli_fetch_assoc($landlord)) 
                  {
                    echo "<option>".$row['lastname']."</option>";
                  }
            ?>
        </select><br>
        <select name="housetype" class="form-control">
            <option>Duplex</option>
            <option>Single</option>
            <option>Double</option>
        </select><br>
        <input type="submit" name="submit" value="submit" class="btn btn-outline-danger">
    </form>
</body>
<hr/>
</html>
<?php 
if(isset($_POST['submit'])){ 
    // Include the database configuration file 
    include ("../includes/database.php"); 
    $str = uniqid('', true);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $housetype = $_POST['housetype'];
    $location = $_POST['location'];
    $text = $_POST['text'];
    if(empty($location) || empty($text))
    {
        echo "<script>window.alert('fill in all fields')</script>";
        exit();
    }
    else
    {
        $upload = mysqli_query($conn, "INSERT INTO posts(firstname, lastname, location, housetype, date, info, uniqueid) VALUES('$firstname', '$lastname', '$location', '$housetype', NOW(), '$text', '$str')");
    }
    // File upload configuration 
    $filename = $_FILES['img']['name'];
    $tmpname = $_FILES['img']['tmp_name'];
    $filetype = $_FILES['img']['type'];
    for($i = 0; $i<=count($tmpname)-1; $i++)
    {
        $img_name = addslashes($filename[$i]);
        $tmp = addslashes(file_get_contents($tmpname[$i]));                                                                                          
        $query = mysqli_query($conn, "INSERT INTO images(name,image,firstname,lastname,uniqueid) VALUES ('$img_name', '$tmp', '$firstname', '$lastname', '$str')");
    }
    echo "<script>window.alert('Success!')</script>";
}  
?>