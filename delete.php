<?php

    // Database Connection
    $conn = mysqli_connect("localhost","root","","myblogs");
     require('./config.php');

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $id = $_GET["id"];

        $sql = mysqli_query($conn, "DELETE FROM `blogs` WHERE id=$id");

        if($sql){
            header("Location: ./index.php");
            exit;
        }
        else{
                die("Something Went Wrong".mysqli_error($conn));
        }
    }

?>