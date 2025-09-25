<?php
session_start();
if($_SESSION["id"] == true){
        $name = $_SESSION["name"];
      
}
   

$conn = mysqli_connect("localhost", "root", "", "myblogs");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap works</title>
    <!--Font Awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
    <!--Bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!--custom css link-->
    <link rel="stylesheet" href="./css/style.css" />
    <!-- Box Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-4">

  <div class="d-flex justify-content-end align-items-center gap-2 mb-3">
    <?php
    if (isset($_SESSION["name"])) {
        echo "<span class='text-white fw-semibold'>Welcome, " . htmlspecialchars($_SESSION["name"]) . "</span>";
    } else {
        echo '<span class="text-white">Guest</span>';
    }
    if (isset($_SESSION["image"]) && !empty($_SESSION["image"])) {
        $image = htmlspecialchars($_SESSION["image"]);
        echo "<img src='./db-images/users/$image' alt='User Image' class='rounded-circle' style='width:40px; height:40px; object-fit:cover; background:black;'>";
    } else {
        echo "<img src='./path-to-user-images/default.png' alt='Default User' class='rounded-circle' style='width:40px; height:40px; object-fit:cover;'>";
    }
    ?>
  </div>

  <div class="row mb-3 px-3">
    <div class="col-12 d-flex flex-wrap gap-2">
      <a href="create.php" class="btn btn-success flex-grow-1 flex-sm-grow-0"><i class="fa fa-plus"></i> Add Blog</a>
      <a href="index.php" class="btn btn-primary flex-grow-1 flex-sm-grow-0"><i class="fa fa-list"></i> Manage Blogs</a>
      <a href="index1.php" class="btn btn-primary ms-auto">Back To Home</a>
    </div>
  </div>

  <div class="content px-3">
    <h2 class="page-title mb-4 text-center">Blog Listings</h2>
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle text-center">
        <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Cover</th>
            <th>Category</th>
            <th colspan="2">Options</th>
          </tr>
        </thead>
        <tbody>
        <?php
       $result = mysqli_query($conn, "SELECT * FROM `blogs` WHERE TRIM(author)='$name'");
        if ($result && mysqli_num_rows($result) > 0) {
            $sn = 1;
            while ($blog = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$sn}</td>
                    <td>" . htmlspecialchars($blog['title']) . "</td>
                    <td><img src='./db-images/" . htmlspecialchars($blog['image']) . "' width='60' height='60' style='object-fit:cover;'></td>
                    <td>" . htmlspecialchars($blog['category']) . "</td>
                    <td>
                        <a href='edit.php?id={$blog['id']}' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> Edit</a>
                    </td>
                    <td>
                        <a href='delete.php?id={$blog['id']}' class='btn btn-danger btn-sm' onclick='return confirmDelete();'><i class='fa fa-trash'></i> Delete</a>
                    </td>
                </tr>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='7'>No blogs found.</td></tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function confirmDelete() {
    return confirm("Confirm blog delete?");
}
</script>

</body>
</html>
