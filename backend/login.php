<?php
session_start();

// Database Connection
$db = mysqli_connect("localhost", "root", "", "myblogs");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        header("Location: ../login.php?msg=" . urlencode("All fields are required"));
        exit;
    }

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {  
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["image"] = $row["image"]; 
            $_SESSION["author"] = $row["author"]; 
               $_SESSION["email"] = $row["email"]; 

            header("Location: ../index1.php");
        } else {
            header("Location: ../login.php?msg=" . urlencode("Wrong Password"));
        }
    } else {
        header("Location: ../login.php?msg=" . urlencode("User Not Registered"));
    }
    exit;
}
?>

