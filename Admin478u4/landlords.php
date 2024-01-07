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
    <?php require("navbar.php");?>
    <table class="table table-hover table-light container" id="table">
    <tr class="table-success">
        <td colspan="5"><b>tenants</b></td>
    </tr>
    <tr>
        <td>Firstname</td>
        <td>lastname</td>
    </tr>
    </thead>
    <tbody>
        <?php
        //$name = htmlspecialchars($_SESSION['username']);
        $query_user = mysqli_query($conn,"SELECT * FROM landlords ORDER BY id ASC")or die(mysqli_error($conn));

        $results_per_page = 4;
        
        $number_of_results = mysqli_num_rows($query_user);
        //getting total number of pages
        $number_of_pages = ceil($number_of_results/$results_per_page);
        //determining page number
        if(!isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page=$_GET['page'];
        }

        $this_page_first_result = ($page-1)*$results_per_page;
        $query_user = mysqli_query($conn,"SELECT * FROM landlords ORDER BY id ASC LIMIT " . $this_page_first_result . ',' . $results_per_page)or die(mysqli_error($conn));
        //$query_user = mysqli_query($conn,"SELECT * FROM tenants WHERE landlord = '$name' ORDER BY datepaid ASC")or die(mysqli_error($conn));
        if(mysqli_num_rows($query_user) > 0){
            while($res = mysqli_fetch_array($query_user) ){
            $id = $res['id'];   
            $firstname = $res['firstname'];
            $lastname = $res['lastname'];
            ?>
            <tr>
                <td><?php echo $firstname?></td>
                <td><?php echo $lastname; ?></td>
                <!--<td><//?php echo $phone; ?></td>-->
                <td align="center"><a href="delete_landlord.php?uid=<?php echo $id; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><span class="glyphicon glyphicon-trash"></span>delete</a>

                </td>

            </tr>
            <?php
            }
        }
        else{
        ?>
        <tr>
            <td colspan="5">No Result Found.</td>
        </tr>
        <?php   
        }
        ?>
        <tr>
            <td colspan="5" align="center"><font size="1px">All Rights Reserved. molise mahasele. &copy; 2021</font></td>
        </tr>
    </tbody>
</table>
<?php    echo "<b align='center' style='margin-left:6px;'>Pages: </b> ";
                for($page=1;$page<=$number_of_pages;$page++)
                {
                    echo '<a href="landlords.php?page=' . $page . '"> ' . $page . '</a> ';
                }
                ?>