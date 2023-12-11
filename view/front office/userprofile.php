
<?php

require 'C:\xampp\htdocs\web1\connection.php';
session_start();
$id = $_SESSION['id'];

if(!isset($id)){
   header('location:signup.php');
};

if(isset($_GET['logout'])){
   unset($id);
   session_destroy();
   header('location:logout.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CultureArt Mondo</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body id="page-top">
    <!-- Navigation-->
    <!--<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">CultureArt Mondo</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="userprofile.php">profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="livre.php">Livre</a></li>
                    <li class="nav-item"><a class="nav-link" href="worshop.html">Workshop</a></li>
                    <li class="nav-item"><a class="nav-link" href="artwork.php">Art Work</a></li>
                    <li class="nav-item"><a class="nav-link" href="events.html">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="userprofile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>-->

    <div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($con, "SELECT * FROM `register` WHERE id = '$id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['first_name']; ?></h3>
      <a href="update_profile.php" class="btn">update profile</a>
      <a href="logout.php" class="delete-btn">logout</a>
      <a href="site.php" class="btn">Back to Web-site</a>
   </div>

</div>

</body>
</html>