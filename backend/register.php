<?php
// Database Connection//
$db = mysqli_connect("localhost", "root", "", "myblogs");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name   = $_POST["username"];
    $email  = $_POST["email"];
    $phone  = $_POST["phone"];
    $gender  = $_POST["gender"];
    $password  = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Create User ID//
    $userid = md5(substr($name, 0, 3) . substr($phone, 0, 3) . random_int(10000, 99999));

    // File Upload//
    $filename  = $_FILES["image"]["name"];
    $ext       = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $newFile   = md5("image" . $filename) . "." . $ext;
    $uploaddir = "../db-images/users/" . $newFile;

    // Validation//
    if (!$name || !$email || !$phone || !$gender || !$password || !$cpassword || !$filename) {
        header("Location: ../register.php?msg=" . urlencode("All fields are required"));
        exit;
    }
    if ($password !== $cpassword) {
        header("Location: ../register.php?msg=" . urlencode("Password should match"));
        exit;
    }
    if (!in_array($ext, ["jpg", "jpeg", "png"])) {
        header("Location: ../register.php?msg=" . urlencode("Image Not Accepted"));
        exit;
    }

    // Move file//
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $uploaddir)) {
        header("Location: ../register.php?msg=" . urlencode("Image Not Moved"));
        exit;
    }

    // Insert into DB//
    $query = "INSERT INTO users (name, phone, email, gender, image, password, userid) 
              VALUES ('$name','$phone','$email','$gender','$newFile','$password','$userid')";
    
    if (mysqli_query($db, $query)) {
        header("Location: ../login.php");
    } else {
        header("Location: ../register.php?msg=" . urlencode("Something went WRONG: " . mysqli_error($db)));
    }
    exit;
}
?>
