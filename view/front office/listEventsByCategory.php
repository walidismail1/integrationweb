<?php
include '../../controller/EventC.php';
include '../../model/Event.php';

$eventC = new EventC();
$error = "";
$events = [];
$categories = $eventC->listCategories();

// Vérifier si une catégorie est sélectionnée
if (isset($_GET['idCategorie']) && $_GET['idCategorie'] !== 'all') {
    $idCategorie = $_GET['idCategorie'];
    $events = $eventC->listEventsByCategory($idCategorie); // Filtrer par catégorie si sélectionnée
} else {
    // Afficher tous les événements si aucune catégorie n'est sélectionnée
    $events = $eventC->listEvents();
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
    <link href="css/styles.css" rel="stylesheet" />
</head>
<style>
    a {
        color: #0000ff; /* Blue color for hyperlinks */
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="site.php">CultureArt Mondo</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="livre.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="listEventsByCategory.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="callender.php">calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="userprofile.php">Profile</a></li>
                </ul>
                   
                    
                    

            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">CultureArt Mondo</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Art, Culture, and Creativity</h2>
                    <a class="btn btn-primary" href="#about">Explore</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Welcome to CultureArt Mondo</h2>
                    <p class="text-white-50">
                        Immerse yourself in the world of art, culture, and creativity. Explore our diverse collection of artworks and connect with like-minded individuals. CultureArt Mondo is your gateway to artistic inspiration and cultural exploration.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="assets/img/Art_Gallery.png" alt="Art Gallery">
        </div>
    </section>
    <!-- Projects-->
    <section class="events-section" id="events">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center">Upcoming Events</h2>

            <!-- Form to filter events by category -->
            <form action="" method="GET">
                <label for="idCategorie">Select Category:</label>
                <select name="idCategorie" id="idCategorie">
                    <option value="all">All Events</option> <!-- Option pour afficher tous les événements -->
                    <?php
                    foreach ($categories as $category) {
                        $selected = ($category['idCategorie'] == $idCategorie) ? 'selected' : '';
                        echo "<option value='{$category['idCategorie']}' $selected>{$category['nomC']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Filter">
            </form>

            <div class="row">
    <?php
    foreach ($events as $event) {
        $isCapacityZero = $event['capacite'] == 0;
    ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-top" src="uploads/ipad.png" alt="Event Image">
                <div class="card-body">
                    <h5 class="card-title"><?= $event['nom']; ?></h5>
                    <p class="card-text"><?= $event['description']; ?></p>
                    <p class="card-text">Date: <?= $event['date']; ?></p>
                    <p class="card-text">Location: <?= $event['lieu']; ?></p>

                    <?php
                    $address = urlencode($event['lieu']);
                    $mapsLink = "https://www.google.com/maps/dir//$address";
                    ?>
                    <a href="<?= $mapsLink ?>" target="_blank">Get Directions</a>

                    <form method="POST" action="sendReservationConfirmation.php">
                <input type="hidden" name="event_id" value="<?= $event['idevent']; ?>">
                <input type="submit" name="reserve" <?php if ($isCapacityZero) echo 'disabled'; ?> value="Réserver" style="background-color: #8cbf52; color: #fff; border: none; padding: 5px 10px; cursor: pointer;">
                <?php if ($isCapacityZero) echo '<span style="color: red;">(Capacity Full)</span>'; ?>
            </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="contact-section bg-black" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="#!">CulturArtMondo@gmail.com</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">+216 (555) 902-8832</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; CultureArt Mondo 2023</div></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
