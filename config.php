<?php
    $conn = mysqli_connect('localhost',"root","","myblogs");
    if($conn){
    }
    else{
        die("Failed".mysqli_connect_error());
    }
?>