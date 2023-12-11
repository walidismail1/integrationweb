<?php

use Google\Service\AIPlatformNotebooks\Location;

include ('C:\xampp\htdocs\web1\controller\commandeC.php');
include ('C:\xampp\htdocs\web1\model\commande.php');
include ('C:\xampp\htdocs\web1\model\artwork.php');
if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    
    if (
        isset($_POST['email']) &&
        isset($_POST['title']) &&
        isset($_POST['nom']) &&
        isset($_POST['prenom']) &&
        isset($_POST['price']) &&
        isset($_POST['description'])
    ) {
        $cmd = new commande(
            0,
            $_POST['email'],
            $_POST['nom'],
            $_POST['prenom'],
           34
        );
        $art = new artwork(
            $_POST['title'],
            "",
            number_format($_POST['price']),
            $_POST['description']
        );
        $AR = new commandeC();
$liste = $AR-> addArticleCommande($cmd, $art);
header('Location: artwork.php');
    }
    
/*
if (isset($_GET["id"])) {
  $adC = new artworkC();
  $adC->supprimer($_GET["id"]);
  header('Location:tableau.php');
}*/
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>

  <!-- CSS Files -->
  <link id="pagestyle" href="css/styleContactUs.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
<?php include_once 'header.php'; ?>
  <div class="container-fluid py-4">
    
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <div class="contact-form">
        <h1>Add Art Work</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>Formulaire</h2>
                    <form action="#" method="post">
                    <input type="email" placeholder="enter email" name="email" class="form-control">
                    <input type="text" placeholder="enter your first name" name="nom" class="form-control">
                    <input type="text" placeholder="enter your last name" name="prenom" class="form-control"> 
                    <input type="text" placeholder="enter title" name="title" class="form-control"> 
                    <input type="text" placeholder="enter  price" name="price" class="form-control">
                    <input type="text" placeholder="enter  description" name="description" class="form-control">
                                      
             <button type="submit" class="btn" name="add" value="add ">Send<i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="form-img">
                    <img src="ipad.png" alt="">
                </div>
            </div>
        </div>
    </div> 
      </form>
</div>
<?php include_once 'footer.php'; ?>
</body>

</html>