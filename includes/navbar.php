<?php
if(isset($_POST['search']))
{
    $location = $_POST['search_text'];
    header("location: location_search.php?location=$location");
}
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary" >
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="assets/plug.png" alt="The Plug" width="100px" height="80px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" style="color:white;" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color:white;">Contact Us</a>
        </li>
      </ul>
      
      <!-- Search Bar -->
      <form class="d-flex" method="POST">
        <input class="form-control me-2" name="search_text" type="search" placeholder="Search" aria-label="Search">
        <input class="btn btn-primary" type="submit" name="search" value="Search">
      </form>
    </div>
  </div>
</nav>
<br>

