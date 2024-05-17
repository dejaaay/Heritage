<?php
include ('../../connect/connect.php');
if (isset($_GET['deleteid'])){
    $restos_id=$_GET['deleteid'];
    $sql="delete from `restos` where restos_id=$restos_id";
    $result=mysqli_query($con,$sql);
    if ($result) {
        header('location:admin-restos.php');
    }
    else {
        die(mysqli_error($con));
    }
}


?>