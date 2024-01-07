<?php
require("includes/database.php");

$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$postImg = mysqli_query($conn, "SELECT * FROM images WHERE firstname='$firstname' AND lastname='$lastname'");
$details = mysqli_query($conn, "SELECT * FROM details WHERE firstname='$firstname' AND lastname='$lastname'");
$landlords = mysqli_query($conn, "SELECT * FROM landlords WHERE firstname='$firstname' AND lastname='$lastname'");
$row = mysqli_fetch_assoc($landlords);
$posts = mysqli_query($conn, "SELECT * FROM posts WHERE firstname='$firstname' AND lastname='$lastname'");
$rowPosts = mysqli_fetch_assoc($posts);

$rowDetails = mysqli_fetch_assoc($details);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>An-k</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- Navbar -->
<?php require("includes/navbar.php"); ?>

<!-- Hero Section -->
<section class="bg-primary" style="color:white;">
<div class="jumbotron text-center">
    <h1>Your dream home awaits you!</h1>
</div>

    <div class="container bg-primary rounded" >
        <div class="row">
            <div class="col-md-6">
                <h3>Property Description</h3>
                <p><?php echo $rowPosts['info']; ?></p>
                <p><?php echo $rowDetails['info']; ?></p>
            </div>
            <div class="col-md-6">
                <h3>More details</h3>
                <ul>
                    <?php
                    echo '<ion-icon name="location-outline" size="large"></ion-icon> <b>'.$row['location'].'</b>';
                    echo '<br><ion-icon name="home-outline" size="large"></ion-icon> <b>'.$row['housetype'].'</b>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-5">
    <div class="container">
        <h2 class="text-center">Photo Gallery</h2>
        <!-- Add your property photos here -->
        <div class="row">
            <?php
            while($rowPosts = mysqli_fetch_assoc($postImg))
            {
                echo '<div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" height="175px" alt="Property Image 1" src="data:image/jpeg;base64,'.base64_encode( $rowPosts['image'] ).'"/">
                </div>
            </div>';
            }
            ?>
            
        </div>
    </div>
</section>

<!-- Details Section -->


<!-- Bootstrap JS and jQuery -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
