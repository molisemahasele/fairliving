<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}

require("../includes/database.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>FairLiving</title>
  </head>
  <body>


<?php
require("navbar.php");

$select = mysqli_query($conn, "SELECT * FROM posts");

$results_per_page = 3;
        
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

$select = mysqli_query($conn, "SELECT * FROM posts ORDER BY id ASC LIMIT " . $this_page_first_result . ',' . $results_per_page );

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
        echo '
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">';
                    echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/">';
                    echo '<details><summary>click to see more/less</summary>';
                    while ($row2 = mysqli_fetch_assoc($select2)) 
                    {
                        echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $row2['image'] ).'"/"><br>';
                    }
                    echo '</details>';
                    echo '<div class="card-body">
                        <h5 class="card-title">'.$row['location'].'</h5>
                        <p class="card-text"><b>'.$row['houseType'].'</b><br>'.$row['info'].'<br>'.$row['date'].'</p>
                        <a href="delete_house.php?id='.$id.'" class="btn btn-outline-danger">delete</a>
                    </div>
                </div>
            </div>';
    //}
}

echo "</div></div>";

echo "<br>";
echo '<nav aria-label="Page navigation example" class="container">

      <ul class="pagination">';
for($page=1;$page<=$number_of_pages;$page++)
{
    echo '<li class="page-item"><a class="page-link" href="houses.php?page=' . $page . '" > ' . $page . '</a></li>';
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
  </body>
</html>
