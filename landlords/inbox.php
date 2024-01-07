<?php
session_start();
if(!isset($_SESSION['adminId']))
{
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>houses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/inboxStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 250px; padding: 20px; }
    </style>
</head>
<body>
<?php
require("navbar.php");
require("../includes/database.php");

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

$delete = mysqli_query($conn, "DELETE FROM msgcount WHERE status=1");

$landlords_msg = mysqli_query($conn, "SELECT * FROM landlords_msg WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname'");

$first = $_GET['firstname'];
$last = $_GET['lastname'];

$landlord_id = $_SESSION['adminId'];

?>

<main class="content">
    <div class="container p-0">

        <h1 class="h3 mb-3">Messages</h1>
    </div>
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">


                    <?php 

                    $replies = mysqli_query($conn, "SELECT * FROM replies WHERE tenant_firstname='$first' AND tenant_lastname='$last' AND landlord_firstname='$firstname' AND landlord_lastname='$lastname' ORDER BY id ASC");
                    $landlords_msg2 = mysqli_query($conn, "SELECT * FROM landlords_msg WHERE landlord_firstname='$firstname' AND landlord_lastname='$lastname' AND tenant_firstname='$first' AND tenant_lastname='$last'");
                    $tenants = mysqli_query($conn, "SELECT * FROM tenants WHERE firstname='$first' AND lastname='$last'");
                    $tenants2 = mysqli_query($conn, "SELECT * FROM tenants WHERE landlord_first='$firstname' AND landlord_last='$lastname'");
                    $profileLandlord = mysqli_query($conn, "SELECT * FROM profileimg WHERE firstname='$firstname' AND lastname='$lastname'");
                    $profileLandlordRow = mysqli_fetch_assoc($profileLandlord);

                    $profileTenant = mysqli_query($conn, "SELECT * FROM tenantsprofileimg WHERE firstname='$first' AND lastname='$last'");
                    $profileTenantRow = mysqli_fetch_assoc($profileTenant);
                    $tenants_row = mysqli_fetch_assoc($tenants);
                    $tenant_id = $tenants_row['id'];

                    while($row_msg = mysqli_fetch_assoc($tenants2))
                    {

                        $tenant_firstname = $row_msg['firstname'];
                        $tenant_lastname = $row_msg['lastname'];
                        $profile = mysqli_query($conn, "SELECT * FROM tenantsprofileimg WHERE firstname='$tenant_firstname' AND lastname='$tenant_lastname'");
                        $profileRow = mysqli_fetch_assoc($profile);
                        $tenantQuery = mysqli_query($conn, "SELECT * FROM tenants WHERE firstname='$tenant_firstname' AND lastname='$tenant_lastname'");
                        $tenantRow = mysqli_fetch_assoc($tenantQuery);
                        $id = $tenantRow['id'];

                        echo '<a href="inbox.php?firstname='.$tenant_firstname.'&lastname='.$tenant_lastname.'" class="list-group-item list-group-item-action border-0">
                        <div class="d-flex align-items-start">';
                        
                        if($profileRow['status'] == 0)
                        {
                            echo '<img class="rounded-circle mr-1" src="../tenants/uploads/profile'.$id.'.jpg" width="40" height="40">';
                        }
                        elseif($profileRow['status'] == 1) 
                        {
                            echo '<img class="rounded-circle mr-1" src="../tenants/uploads/profiledefault.jpg" width="40" height="40">';
                        }    

                        echo  '<div class="flex-grow-1 ml-3">
                                '.$row_msg['firstname'].' '.$row_msg['lastname'].'
                            </div>
                        </div>
                    </a>';
                    }

                    ?>

                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                
                     <div class="col-12 col-lg-5 col-xl-3 border-right">
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <?php 

                            while($replies_row = mysqli_fetch_assoc($replies))
                            {
                            if($replies_row['status'] == 0)
                            {
                                echo '<div class="chat-message-left pb-4">
                                <div>';
                                    
                                if($profileLandlordRow['status'] == 0)
                                {
                                    echo '<img src="uploads/profile'.$landlord_id.'.jpg" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">';
                                }
                                elseif($profileLandlordRow['status'] == 1)
                                {
                                    echo '<img src="uploads/profiledefault.jpg" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">';
                                }

                                echo'<div class="text-muted small text-nowrap mt-2">'.$replies_row['date'].'</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1"><b>'.$firstname.'</b></div>
                                    '.$replies_row['info'].'
                                </div>
                                </div>';
                            }
                            elseif($replies_row['status'] == 1)
                            {
                                echo '<div class="chat-message-right pb-4">
                                <div>';
                                    
                                if($profileTenantRow['status'] == 0)
                                {
                                    echo '<img src="../tenants/uploads/profile'.$tenant_id.'.jpg" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">';
                                }
                                elseif($profileTenantRow['status'] == 1)
                                {
                                    echo '<img src="..tenants/uploads/profiledefault.jpg" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">';
                                }

                                echo '<div class="text-muted small text-nowrap mt-2">'.$replies_row['date'].'</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1"><b>'.$replies_row['tenant_firstname'].'</b></div>
                                    '.$replies_row['info'].'
                                </div>
                                </div>';
                            }

                            }
                            ?>

                           <!-- <div class="chat-message-right mb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:35 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Cum ea graeci tractatos.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:36 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
                                    Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:37 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Cras pulvinar, sapien id vehicula aliquet, diam velit elementum orci.
                                </div>
                            </div>

                            <div class="chat-message-right mb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:38 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:39 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>

                            <div class="chat-message-right mb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:40 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Cum ea graeci tractatos.
                                </div>
                            </div>

                            <div class="chat-message-right mb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:41 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Morbi finibus, lorem id placerat ullamcorper, nunc enim ultrices massa, id dignissim metus urna eget purus.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:42 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
                                    Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                </div>
                            </div>

                            <div class="chat-message-right mb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:43 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:44 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>-->

                        </div>
                    </div>

                    <div class="flex-grow-0 py-3 px-4 border-top">
                            <form method='POST'>
                            <div class="input-group">
                            <input type="text" name='msg' class="form-control" placeholder="Type your message">
                            <input type='submit' class="btn btn-outline-primary" value='Send' name='submit'>
                            </div>
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php

if(isset($_POST['submit']))
{
    $msg = $_POST['msg'];
    if(empty($msg))
    {
        echo "<script>alert('enter a message')</script>";
        exit();
    }
    $insert_replies = mysqli_query($conn, "INSERT INTO replies(landlord_firstname, landlord_lastname, tenant_firstname, tenant_lastname, info, date, time, status) VALUES ('$firstname', '$lastname', '$first', '$last', '$msg', NOW(), NOW(), 0)");
    $insert_msgCount = mysqli_query($conn, "INSERT INTO msgcount(landlord_firstname, landlord_lastname, tenant_firstname, tenant_lastname, info, date,status) VALUES ('$firstname', '$lastname', '$first', '$last', '$msg', NOW(), 0)");
}