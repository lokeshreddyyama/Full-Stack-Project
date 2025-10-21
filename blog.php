<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myblogs");
 require_once('./config.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
     die("Blog ID is missing.");
}

$id = intval($_GET['id']); // Sanitize input

$sql = "SELECT * FROM blogs WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching blog: " . mysqli_error($conn));
}

$blog = mysqli_fetch_assoc($result);

if (!$blog) {
    die("Blog not found.");
}

$created_at = new DateTime($blog['createdat']);
$formatted_date = $created_at->format("d-m-Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($blog['title']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
<!--Font Style-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<!--Font Awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
</head>
<body>
<div class="container-fluid text-center text-light loki" style="width: 100%;background-color: rgb(3, 3, 42);">
<img src="./db-images/<?= htmlspecialchars($blog['image']) ?>" alt="Blog Image" class="img-fluid mb-4 pt-5" style="max-height: 400px; object-fit: cover;">
<h1 class="mb-4 text-warning"><?= htmlspecialchars($blog['title']) ?></h1>
<div class="mb-3 text-light">
<strong>Author:</strong> <?= htmlspecialchars($blog['author']) ?><br>
<strong>Posted on:</strong> <?= $formatted_date ?>
</div>
<div class="lead"style="  font-family: 'Poppins', sans-serif;font-weight:600; font-size:18px"><?= nl2br(htmlspecialchars($blog['description'])) ?></div>
<a href="./index1.php" class="btn btn-info mb-3">Back to Blogs</a>
</div>
<!-- Footer Section -->
<footer class="bg-black text-light pt-5 pb-3 " style="width:100%; left:0; right:0;">
<div class="container-fluid px-0 mx-0" style="max-width:100vw;">
 <div class="row text-center text-md-start">
 <!-- Brand / About -->
<div class="col-12 col-md-4 mb-4 mx-md-5">
 <h4 class="text-warning">Anime Cards</h4>
 <p class="small">Explore the world of anime through beautifully crafted cards. From iconic characters to legendary stories, we bring you closer to your favorites. Stay connected and discover more!</p>
 </div>
<!-- Quick Links -->
<div class="col-12 col-md-2 mb-4">
 <h5 class="text-warning">Quick Links</h5>
 <ul class="list-unstyled mx-md-1">
<li><a href="#" class="text-light text-decoration-none">Home</a></li>
<li><a href="#About" class="text-light text-decoration-none">About</a></li>
<li><a href="#Blogs" class="text-light text-decoration-none">Blogs</a></li>
<li><a href="./login.php" class="text-light text-decoration-none">Login</a></li>
 </ul>
</div>
<!-- Contact Info -->
 <div class="col-12 col-md-3 mb-4">
 <h5 class="text-warning">Contact Info</h5>
<ul class="list-unstyled">
 <li><a href="#" class="text-light text-decoration-none"><i class="fa-solid fa-location-dot"></i> 5-65, Main Street, Allagadda</a></li>
<li><a href="#" class="text-light text-decoration-none">Nandyal District</a></li>
 <li><a href="#" class="text-light text-decoration-none"><i class="fa-solid fa-envelope"></i> lokeshreddy.1831151@gmail.com</a></li>
<li><a href="#" class="text-light text-decoration-none"><i class="fa-solid fa-phone"></i> +91 9182512295</a></li>
</ul>
</div>
<!-- Social Links -->
<div class="col-12 col-md-2 mb-4">
 <h5 class="text-warning">Follow Me</h5>
 <div class="d-flex justify-content-center justify-content-md-start gap-3">
<a href="https://github.com/lokeshreddyyama" target="_blank" class="text-light fs-4"><i class="fab fa-github"></i></a>
<a href="https://www.linkedin.com/in/lokesh-reddy-yama-88863831a/" target="_blank" class="text-light fs-4"><i class="fab fa-linkedin"></i></a>
 <a href="#" class="text-light fs-4"> <i class="fab fa-twitter"></i></a>
<a href="#" class="text-light fs-4"><i class="fab fa-instagram"></i></a>
 </div>
</div>
 </div>
 <hr class="border-light">
<div class="text-center">
<p class="mb-0 small">&copy; 2025 Anime Cards | Designed by Lokesh Reddy Yama</p>
</div>
</div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
