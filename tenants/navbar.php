<?php require("../includes/database.php"); 
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
?>
<link rel="stylesheet" type="text/css" href="../includes/all.min.css">
<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background:fff;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">An-k</a>
  </div>

<p class="container">
  <a aria-current="page" name="notifications" href="messages.php"><i class="fa-regular fa-2x fa-bell"></i> <?php $select = mysqli_query($conn, "SELECT * FROM notifications WHERE tenant_firstname='$firstname' and tenant_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b style='color:crimson;'>".mysqli_num_rows($select)."</b>";} ?></a>
  <a aria-current="page" href="profile.php"><i class="fa-regular fa-2x fa-user"></i></a>
  <a aria-current="page" href="landlord_profile.php"><i class="fa-solid fa-2x fa-landmark"></i></a>
  <a aria-current="page" href="inbox.php"><i class="fa-regular fa-2x fa-envelope"></i><?php $select = mysqli_query($conn, "SELECT * FROM msgcount WHERE status=0 and tenant_firstname='$firstname' and tenant_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b style='color:crimson;'>".mysqli_num_rows($select)."</b>";} ?></a>
  <a href="logout.php"><i class="fa-solid fa-2x fa-right-from-bracket"></i></a>
</p>
</nav>

<!--
<nav class="navbar sticky-top navbar-expand-lg navbar-expand-sm navbar-light" style="background:fff;">
  <div class="container-fluid">
    
      <ul class="navbar-nav container" style="display:flex;">
        <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" name="notifications" href="messages.php"><img width="30px" height="30px" src="../imgs/not.png"> <?php $select// = mysqli_query($conn, "SELECT * FROM notifications WHERE tenant_firstname='$firstname' and tenant_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b>".mysqli_num_rows($select)."</b>";} ?></a>
        </li>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php"><img width="30px" height="30px" src="../imgs/profile.jpg"></a>
        </li>
      </div>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="landlord_profile.php"><img width="30px" height="30px" src="../imgs/landlord.jpg"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inbox.php">inbox <?php $select// = mysqli_query($conn, "SELECT * FROM msgcount WHERE status=0 and tenant_firstname='$firstname' and tenant_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b>".mysqli_num_rows($select)."</b>";} ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">logout</a>
        </li>
      </ul>
    
  </div>
</nav>-->
<br>
