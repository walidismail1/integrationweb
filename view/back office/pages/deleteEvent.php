<?php
include '../../../controller/EventC.php';

// Création d'une instance du contrôleur des événements
$eventC = new EventC();

if (isset($_GET["id"])) {
    $eventC->deleteEvent($_GET["id"]);
    header('Location: event.php');
}
?>
