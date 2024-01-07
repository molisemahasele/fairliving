<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php');
}

require("../includes/database.php");
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
    $select = mysqli_query($conn, "SELECT * FROM request");

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

$select = mysqli_query($conn, "SELECT * FROM request ORDER BY id DESC LIMIT " . $this_page_first_result . ',' . $results_per_page );


echo '<div class="container">
        <div class="row g-3">';

while($row = mysqli_fetch_assoc($select))
{
    //if($row['firstname'] == $row2['firstname'] and $row['lastname'] == $row2['lastname'])
    //{
        echo '
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">';
                    echo '<div class="card-body">
                          <h3>'.$row['firstname'].' '.$row['lastname'].'</h3>
                        <p class="card-text">'.$row['info'].'<br></p>
                        <p>'.$row['date'].'<br> <a href="delete_request.php?id='.$row['id'].'" class="btn btn-outline-danger">delete</a> 
                        <a href="reply.php?id='.$row['uid'].'" class="btn btn-outline-primary">reply</a>
                        </p>
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
    echo '<li class="page-item"><a class="page-link" href="requests.php?page=' . $page . '" > ' . $page . '</a></li>';
}

echo "</ul></nav>";