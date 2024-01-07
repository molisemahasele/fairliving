<?php 
set_time_limit(60); 

if(isset($_POST['filter']))
{
    $type = $_POST['houses'];
    header("location: welcome.php?type=$type");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style type="text/css">
    .wrapper{ width: 250px; padding: 20px; }
    </style>
    <title>An-k</title>
  </head>
  <body>


<?php
require("loader.html");
require("includes/navbar.php");
require("includes/database.php");
?>
<b class="wrapper">Filter by house type!</b>
<form method="POST" class="wrapper d-flex">
<select name="houses" class="form-control me-2" data-live-search="true">
    <option>Duplex</option>
    <option>Single Room</option>
    <option>Double Room</option>
    <option>Bachelor Pad</option>
    <option>Guest House</option>
</select>
<input type="submit" class="btn btn-primary" value="Filter" name="filter" /> 
</form>

<?php
if(isset($_GET['type']))
{
    $houseType= $_GET['type'];
    $select = mysqli_query($conn, "SELECT * FROM posts WHERE houseType='$houseType'");
}
else
{
    $select = mysqli_query($conn, "SELECT * FROM posts");
}

$results_per_page = 6;
        
$number_of_results = mysqli_num_rows($select);
        
$number_of_pages = ceil($number_of_results/$results_per_page);
        
if(!isset($_GET['page']))
{
    $page = 1;
}
else
{
    $page=$_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$select = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT " . $this_page_first_result . ',' . $results_per_page );

if(isset($_GET['type']))
{
    $houseType= $_GET['type'];
    $select = mysqli_query($conn, "SELECT * FROM posts WHERE houseType='$houseType'");
}
else
{
    $select = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT " . $this_page_first_result . ',' . $results_per_page );
}

echo '<div class="container">
        <div class="row g-3">';

while($row = mysqli_fetch_assoc($select))
{
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $unique = $row['uniqueid'];
    $id = $row['id'];
    $select2 = mysqli_query($conn, "SELECT * FROM images WHERE uniqueid='$unique'");
    $row2 = mysqli_fetch_assoc($select2);
    //if($row['firstname'] == $row2['firstname'] and $row['lastname'] == $row2['lastname'])
    //{
        /*echo '
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">';
                    echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/">';
                    echo '<details><summary class="btn btn-sm">click to see more/less</summary>';
                    while ($row2 = mysqli_fetch_assoc($select2)) 
                    {
                        echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/"><br>';
                    }
                    echo '</details>';
                    echo '<div class="card-body">
                        <p class="card-text"><b>'.$row['houseType'].'</b><br>'.$row['info'].'<br>'.$row['date'].'</p>
        
                    </div>
                </div>
            </div>';*/
            echo '<div class="col mb-5">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" height="170px" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/">
                <details><summary class="btn btn-sm">click to see more/less</summary>';?>
                <?php while ($row2 = mysqli_fetch_assoc($select2)) 
                    {
                       echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/"><br>';
                    }
                    echo '</details>
                <!-- Product details-->
                <div class="card-body p-4">
                <div class="text-center">
                    <h5 class="fw-bolder">'.$row['location'].'</h5>
                    <p class="fw-bolder"><b>'.$row['houseType'].'</b><br></p>
                    <a style="text-decoration:none" href="profile2.php?firstname='.$firstname.'&lastname='.$lastname.'" >More Details</a>
                    <a href="contact.php?firstname='.$firstname.'&lastname='.$lastname.'&id='.$id.'" class="btn btn-primary">Apply</a>
                </div>
                </div>
            </div>
        </div>';
    //}
}

//echo "</div></div>";
echo '</div>
</div>
</section>';

echo "<br>";
echo '<nav aria-label="Page navigation example" class="container">

      <ul class="pagination">';
for($page=1;$page<=$number_of_pages;$page++)
{
    echo '<li class="page-item"><a class="page-link" href="welcome.php?page=' . $page . '" > ' . $page . '</a></li>';
}

echo "</ul></nav>";

?>

    <!--<div class="container">
    	<div class="row g-3">
    		<div class="col-12 col-md-6 col-lg-4">
    			<div class="card">
    				<img src="imgs/1.jpg" alt="apartment building" class="card-img-top">
    				<div class="card-body">
    					<h5 class="card-title">A beautiful apartment for rental.</h5>
    					<p class="card-text">ndndvnom uihiugn nfirgingni cdnunnun
    						jvbudvunduvn kdsvnnuunndfu nfgiunununb</p>
    				</div>
    			</div>
    		</div>
    		<div class="col-12 col-md-6 col-lg-4">
    			<div class="card">
    				<img src="imgs/1.jpg" alt="apartment building" class="card-img-top">
                    <details>
                    <summary>click to see more/less</summary>
                    <img src="imgs/1.jpg" alt="apartment building" class="card-img-top">
                    </details>
    				<div class="card-body">
    					<h5 class="card-title">A beautiful apartment for rental.</h5>
    					<p class="card-text">ndndvnom uihiugn nfirgingni cdnunnun
    						jvbudvunduvn kdsvnnuunndfu nfgiunununb</p>
    				</div>
    			</div>
    		</div>
    		<div class="col-12 col-md-6 col-lg-4">
    			<div class="card">
    				<img src="imgs/1.jpg" alt="apartment building" class="card-img-top">
    				<div class="card-body">
    					<h5 class="card-title">A beautiful apartment for rental.</h5>
    					<p class="card-text">ndndvnom uihiugn nfirgingni cdnunnun
    						jvbudvunduvn kdsvnnuunndfu nfgiunununb</p>
    				</div>
    			</div>
    		</div>
    		<div class="col-12 col-md-6 col-lg-4">
    			<div class="card">
    				<img src="imgs/1.jpg" alt="apartment building" class="card-img-top">
    				<div class="card-body">
    					<h5 class="card-title">A beautiful apartment for rental.</h5>
    					<p class="card-text">ndndvnom uihiugn nfirgingni cdnunnun
    						jvbudvunduvn kdsvnnuunndfu nfgiunununb</p>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>-->
    <hr>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
  </body>
  <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i><img src="assets/theplug.png" width="60px" height="60px" />
          </h6>
          <p>
           An-k is modern way of finding rental properties at the convinience of your smart phone.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">Single Rooms</a>
          </p>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">Duplexes</a>
          </p>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">Double Rooms</a>
          </p>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">Guest Houses</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">Contact</a>
          </p>
          <p>
            <a href="#!" style="text-decoration:none" class="text-reset">About</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Maseru, Ha-Seoli, Lesotho</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@ank.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +266 577 3922</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</html>