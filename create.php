<?php
session_start();

$name=$_SESSION["name"];
 require_once('./config.php');
$conn = mysqli_connect("localhost", "root", "", "myblogs");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $blog_title = trim($_POST["name"]);
    $blog_desc = mysqli_real_escape_string($conn, $_POST["description"]);
    $blog_cat = trim($_POST["category"]);
  
    $image_name = $_FILES["image"]["name"];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $image_new = uniqid("img_") . "." . $image_ext;
    $upload_dir = "./db-images/" . $image_new;

    // Simple validation for required fields
    if ($blog_title && $blog_desc && $blog_cat && $image_name) {
        if (in_array($image_ext, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir)) {
                $blog_code = md5($blog_title . time());
                $sql = "INSERT INTO blogs (title, description, image, category,author, blogid)
                        VALUES ('$blog_title', '$blog_desc', '$image_new', '$blog_cat',' $name', '$blog_code')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Database Insert Error";
                }
            } else {
                $message = "Failed to upload image";
            }
        } else {
            $message = "Image must be JPG, JPEG, or PNG";
        }
    } else {
        $message = "Please fill all fields";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="main">
    <div class="admin-content">
        <div>
            <a href="create.php" class="admin-btn">Add Blog</a>
            <a href="index.php" class="admin-btn">Manage Blogs</a>
        </div>
        <div class="content">
            <h2 class="page-title">New Blog Entry</h2>
            <?php if ($message): ?>
            <div class="error_msg"><?= $message ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <label>Title</label>
                <input type="text" name="name"><br><br>
                <label>Description</label>
                <textarea name="description" rows="20" cols="140"></textarea><br><br>
                <label>Image</label>
                <input type="file" name="image"><br><br>
                <label>Category</label>
                <input type="text" name="category"><br><br>
                
                <button type="submit" class="admin-btn">Add Blog</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
