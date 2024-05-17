<?php
include ('../../connect/connect.php');
if (isset($_GET['deleteid'])){
    $news_id=$_GET['deleteid'];
    $sql="delete from `news` where news_id=$news_id";
    $result=mysqli_query($con,$sql);
    if ($result) {
        header('location:admin-news.php');
    }
    else {
        die(mysqli_error($con));
    }
}


?>