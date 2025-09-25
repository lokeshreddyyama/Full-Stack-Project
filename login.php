<?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Forms</title>
    <!--Bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--custom css link-->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container forms mt-5 mb-5 rounded-3 border border-info bg-dark "style="width:370px;">
    <h1 class="text-center p-3 text-light">Login</h1>
       <?php if (!empty($msg)) { ?>
            <div class="message">
                <div style="text-align:center; color:white;background-color:red;padding:2px"><h5><strong><?php echo htmlspecialchars($msg); ?></strong></h5></div>
            </div> 
        <?php } ?>
    <form action="./backend/login.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-light">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label text-light">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" name="password">
  </div>
   
  <button type="submit" class="btn btn-info mb-3 w-100">Login</button>

  <div class="already-a-member p-3 d-flex flex-column justify-content-center align-items-center text-light">
    <p>Not a member ?<span><a href="./register.php">Register Now</a></span></p>
    <a href="./index.html">Back to Home</a>
</div>
</form>
</div>
      <!--Bootstrap js script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</html>