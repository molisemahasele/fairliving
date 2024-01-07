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
    .wrapper{ width: 400px; padding: 20px; margin-left: 20px;}
    
    .containe{margin-left: 20px;}
    </style>
</head>
<body>
    <?php 
    session_start();
    require("navbar.php");
    require("../includes/database.php");
    if(!isset($_SESSION['adminId']))
    {
        header('Location: ../login.php');
    }

    $sql = "SELECT * FROM landlords";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $id = $_SESSION['adminId'];
        $sqlImg = "SELECT * FROM profileimg WHERE lastname='$lastname' AND firstname='$firstname'";
        $resultImg = mysqli_query($conn, $sqlImg);
        echo '<div class="container" id="services">
      <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">';
        while($rowImg = mysqli_fetch_assoc($resultImg))
        {
            echo "<div class='card'>";
            if($rowImg['status'] == 0)
            {
                echo "<img src='uploads/profile".$id.".jpg' class='card-img-top'>";
            }
            else
            {
                echo "<img src='uploads/profiledefault.jpg' class='card-img-top'>";
            }
        }
    }

    
    
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $id = $_SESSION['adminId'];

    $sql = mysqli_query($conn, "SELECT * FROM landlords WHERE id='$id'");
    $result = mysqli_fetch_assoc($sql);
    $sqlDetails = mysqli_query($conn, "SELECT * FROM details WHERE firstname='$firstname' AND lastname='$lastname'");
    $row = mysqli_fetch_assoc($sqlDetails);

    echo '<br>
            <div class="card-body">
              <p class="card-text">name: <b>'.$result["firstname"].'</b><br>surname: <b>'.$result["lastname"].'
              </b><br>location: <b>'.$result['location'].'</b><br>house type: <b>'.$result['housetype'].'
              </b></p>
            </div>
            <p class="container">'.$row['info'].'</p>
          </div></div>';

        if(isset($_SESSION['adminId']))
        {
            $adminId = $_SESSION['adminId'] ;
            $sql = mysqli_query($conn, "SELECT * FROM landlords WHERE id='$adminId'");
            $row = mysqli_fetch_assoc($sql);
            if($adminId == $row['id'])
            {
                echo "<div class='col-12 col-md-6 col-lg-4'>
                        <h1 class='container'>More Details</h1>
                    <form class='form-control container' action='upload.php' method='POST' enctype='multipart/form-data'>
                    <input type='file' name='file'>
                    <br><button type='submit' name='submit' class='btn btn-outline-primary'>upload</button>
                    </form><br>
                    <form method='POST' class='container'>";?>
                    <input type='text' name='phone' placeholder='phone' class="form-control"><br>
                    <textarea name='info' class="form-control" rows='4' placeholder='house rules and more info like rent'></textarea><br>
                    <?php echo '<input type="submit" name="edit" value="submit" class="btn btn-outline-primary">
                    </form>';
            }
        }

        if(isset($_POST['edit']))
        {
            $info = $_POST['info'];
            $phone = $_POST['phone'];
            if(empty($info))
            {
                echo "<script>window.alert('fill in details!')</script>";
                exit();
            }
            $firstname = $_SESSION['firstname'];
            $lastname = $_SESSION['lastname'];

            $details = mysqli_query($conn, "SELECT * FROM details WHERE firstname='$firstname' AND lastname='$lastname'");

            if(mysqli_num_rows($details) == 0)
            {
                $insert = mysqli_query($conn, "INSERT INTO details(info, firstname, lastname, phone) VALUES('$info','$firstname', '$lastname', '$phone')");
                echo "<script>alert('uploaded successfully')</script>";
            }
            else
            {
                $update = mysqli_query($conn, "UPDATE details SET info='$info',firstname='$firstname', lastname='$lastname', phone='$phone' WHERE firstname='$firstname' and lastname='$lastname'");
                echo "<script>alert('updated successfully')</script>";
            }
            
        }

    ?>