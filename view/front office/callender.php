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

    <!-- FullCalendar stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

    <style>
        /* Your styles here */
    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
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
                    <li class="nav-item"><a class="nav-link" href="userprofile.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead -->
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

    <!-- About -->
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

    <!-- Calendar Section -->
    <section class="events-section" id="events">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center">Upcoming Events</h2>

            <!-- Form to filter events by category -->
            <form action="" method="GET">
                <label for="idCategorie">Select Category:</label>
                <select name="idCategorie" id="idCategorie">
                    <option value="all">All Events</option>
                    <?php
                    foreach ($categories as $category) {
                        $selected = ($category['idCategorie'] == $idCategorie) ? 'selected' : '';
                        echo "<option value='{$category['idCategorie']}' $selected>{$category['nomC']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Filter">
            </form>

            <div id="calendar"></div>

            <!-- Event information dialog -->
            <div id="eventInfo" style="display: none;"></div>
        </div>
    </section>

    <!-- Signup -->
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <!-- ... (your existing signup section code) ... -->
            </div>
        </div>
    </section>

    <!-- Contact -->
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

    <!-- Footer -->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">
            Copyright &copy; CultureArt Mondo 2023
        </div>
    </footer>

    <!-- Include Bootstrap JS and your custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                events: [
                    <?php foreach ($events as $event) { ?>
                        {
                            title: '<?php echo $event['nom']; ?>',
                            start: '<?php echo $event['date']; ?>',
                            end: '<?php echo $event['date']; ?>',
                            color: '#8cbf52', /* Pistachio green */
                            textColor: '#fff',
                            lieu: '<?php echo $event['lieu']; ?>',
                            description: '<?php echo $event['description']; ?>',
                            capacite: '<?php echo $event['capacite']; ?>',
                            idevent: '<?php echo $event['idevent']; ?>' // Ajout de l'ID de l'événement
                        },
                    <?php } ?>
                ],
                eventClick: function (calEvent, jsEvent, view) {
                    $('#eventInfo').html('<strong>' + calEvent.title + '</strong><br>' +
                        'Date: ' + calEvent.start.format('YYYY-MM-DD') + '<br>' +
                        'Lieu: ' + calEvent.lieu + '<br>' +
                        'Description: ' + calEvent.description + '<br>' +
                        'Capacité: ' + calEvent.capacite
                    );
                    $('#eventInfo').dialog({
                        modal: true,
                        title: calEvent.title,
                        width: 300,
                        height: 'auto'
                    });
                }
            });
        });
    </script>
</body>

</html>
