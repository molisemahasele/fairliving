<?php require("../includes/database.php"); 
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
?>
<link rel="stylesheet" type="text/css" href="../includes/all.min.css">
<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background:fff;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">An-K</a>
  </div>
      <!--<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inbox.php?firstname=name&lastname=lname">inbox <?php $select //= mysqli_query($conn, "SELECT * FROM msgcount WHERE status=1 and landlord_firstname='$firstname' and landlord_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b>".mysqli_num_rows($select)."</b>";} ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="messaging.php">alert</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="paid_tenants.php">paid</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="tenants.php">tenants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="change_password.php">change password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">logout</a>
        </li>
      </ul>-->

  <p class="container">
    <a aria-current="page" href="inbox.php?firstname=name&lastname=lname"><i class="fa-regular fa-2x fa-envelope"></i><?php $select = mysqli_query($conn, "SELECT * FROM msgcount WHERE status=1 and landlord_firstname='$firstname' and landlord_lastname='$lastname'"); if(mysqli_num_rows($select) > 0){echo "<b style='color:crimson;'>".mysqli_num_rows($select)."</b>";} ?></a>
    <a aria-current="page" href="messaging.php"><i class="fa-solid fa-2x fa-triangle-exclamation"></i></a>
    <a aria-current="page" href="paid_tenants.php"><i class="fa-solid fa-2x fa-file-invoice-dollar"></i></a>
    <a aria-current="page" href="tenants.php"><i class="fa-solid fa-2x fa-building-user"></i></a>
    <a aria-current="page" href="change_password.php"><i class="fa-solid fa-2x fa-key"></i></a>
    <a href="logout.php"><i class="fa-solid fa-2x fa-right-from-bracket"></i></a>
  </p>
</nav>
<br>
