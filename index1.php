<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myblogs");

if(isset($_GET["id"])){
$id = $_GET["id"];
}
 require_once('./config.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bootstrap works</title>
<!--Font Awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
<!--Bootstrap css link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<!--custom css link-->
<link rel="stylesheet" href="./css/style.css">
<!--Font Style-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>

<!-- Box Icons -->
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
<div class="container">
<a class="navbar-brand fw-bold" style="font-weight:700px;font-size:30px;" href="#">
<i class="fas fa-paw"></i> Anime Cards
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#animeNavbar" aria-controls="animeNavbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="animeNavbar">
<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link text-dark" style="font-weight:700px;font-size:18px;" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link text-dark"style="font-weight:700px;font-size:18px;" href="#About">About</a></li>
<li class="nav-item"><a class="nav-link text-dark"style="font-weight:700px;font-size:18px;" href="#Blogs">Blogs</a></li>


 <?php if(isset($_SESSION["id"])): ?>
 <li class="nav-item"><a class="nav-link text-dark" style="font-weight:700px;font-size:18px;" href="./index.php">Create a Blog</a></li>
 <li class="nav-item"><a class="nav-link text-danger" style="font-weight:700px;font-size:18px;" href="./backend/logout.php">Logout</a></li>
 <?php else: ?>
 <li class="nav-item"><a class="nav-link text-dark" style="font-weight:700px;font-size:18px;" href="./login.php">Login</a></li>
 <?php endif; ?>
</ul>
 </div>
</div>
</nav>


<!--
    <div class="banner">
        <h1>
            Welcome <?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : ""; ?>
        </h1>
    </div> -->



<div class="slide-container">
<div class="slide">
 <img src="./images/bg1.jpg" alt="">
 <div class="caption">Whispers of Sakura Lake</div>
</div>
 <div class="slide">
 <img src="./images/bg2.jpg" alt="">
<div class="caption">Painted Spirits</div>
</div>
<div class="slide">
 <img src="./images/bg6.jpg" alt="">
 <div class="caption">Whispers of the Mountain Moon</div>
 </div>
<div class="slide">
 <img src="./images/bg4.jpg" alt="">
 <div class="caption">Sunrise Sky Realms</div>
</div>
<div class="slide">
 <img src="./images/bg5.jpg" alt="">
<div class="caption">Moonlit Dreamscape</div>
</div> 
<div class="slide">
 <img src="./images/bg3.jpg" alt="">
 <div class="caption">Starlit Lake Mirage</div>
</div> 
 <span class="arrow prev" onclick="controller(-1)">&#10094;</span>
 <span class="arrow next" onclick="controller(1)">&#10095;</span>
</div>
 <!-- About Section -->
<div class="about-container loki2 text-center" id="About">
 <img src="./images/loki.jpg" alt="Profile Image">
<div class="about-content">
<h2>About Me</h2>
 <p class="container text-center" style="width:100%;margin-left: 32px;">I'm a full stack developer capable of designing and developing 
responsive web sites and web apps. I am experienced in the front-end technologies of HTML, CSS, JavaScript, React, and Bootstrap to build
user interfaces. On the back-end I utilize Node.js and PHP, which I use to build server-side logic and APIs. I maintain databases 
using MySQL and MongoDB to store and retrieve data. I am experienced with Git and GitHub for version control and collaboration, 
which helps me to develop clean and maintainable code. I take on complex problems and endeavor to learn new technologies to become a 
better developer as well as produce the digital solutions clients want. I focus on providing functional, scalable, secure and 
user-friendly applications from conception to deployment while maintaining development best practices.</p>
<a href="https://lokeshreddyyama.github.io/Portfolio1/" class="btn1" style="margin-right:10px;">Read More</a>
 <div class="social-icons loki3">
 <a href="https://github.com/lokeshreddyyama" aria-label="GitHub" target="_blank" rel="noopener"><i class="fab fa-github"></i></a>
<a href="https://www.linkedin.com/in/lokesh-reddy-yama-88863831a/" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin"></i></a>
<a href="#contact" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
</div>
</div>
</div>
<!--Blogs Section-->

<div class="container ">
<div class="row row-cols-1 row-cols-md-4 g-4">
 <?php
 $name = $_SESSION["name"];
 $blogs = mysqli_query($conn, "SELECT * FROM `blogs`");


 if (!$blogs) {
die("Query Failed: " . mysqli_error($conn));
 }


if (mysqli_num_rows($blogs) > 0) {
 while ($row = mysqli_fetch_assoc($blogs)) {
$original_date = new DateTime($row['createdat']);
 $new_date = $original_date->format("d-m-Y");
 $uniqueId = 'descCollapse' . $row['id']; // unique collapse id per blog

 echo "
<div class=' container col mb-4'>
<div class=' card border-info add' style='width: 18rem; height: 500px; margin-left:12px;border:1px solid;background-color:rgb(7, 7, 42);;'>
<img src='./db-images/" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='" . htmlspecialchars($row['title']) . "' style='height: 330px; object-fit: cover;' />
 <div class='card-body d-flex flex-column'>
 <h5 class='card-title text-warning'>" . htmlspecialchars($row['title']) . "</h5>
<div class='mt-auto'>
<small class='text-light'>Blog by: " . htmlspecialchars($row['author']) . "</small><br>
<small class='text-light'>Posted on: $new_date</small><br>
<a href='./blog.php?id=" . $row['id'] . "' class='btn btn-info mt-2' style='width: 100%;'>Read More</a>
 </div>
 </div>
 </div>
 </div>
 ";
 }
 } else {
 echo "<div class='col-12'><div class='alert alert-info'>No blogs found for this author.</div></div>";
 }
 ?>
 </div>
</div>


<!-- Include Bootstrap JS for collapse functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


<!-- Add Bootstrap JS for collapse to work -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


<!-- Footer Section -->
<footer class="bg-black text-light pt-5 pb-3 mt-5" style="width:100%; left:0; right:0;">
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



<!--Bootstrap Js script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
<script src="./js/script.js"></script>
</body>
</html>
