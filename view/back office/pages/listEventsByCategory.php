<?php
include '../controller/EventC.php';
include '../model/Event.php';

$eventC = new EventC();
$error = "";
$events = [];

// Vérifier si une catégorie est sélectionnée
if (isset($_GET['idCategorie'])) {
    $idCategorie = $_GET['idCategorie'];
    $events = $eventC->listEventsByCategory($idCategorie);
}

// Récupérer toutes les catégories
$categories = $eventC->listCategories();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Events by Category</title>
</head>

<body>
    <button><a href="listEvents.php">Back to all events</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <h2>Filter Events by Category:</h2>

    <!-- Sélectionner une catégorie -->
    <form action="" method="GET">
        <label for="idCategorie">Select Category:</label>
        <select name="idCategorie" id="idCategorie">
            <?php
            foreach ($categories as $category) {
                $selected = ($category['idCategorie'] == $idCategorie) ? 'selected' : '';
                echo "<option value='{$category['idCategorie']}' $selected>{$category['nomC']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <h2>Events:</h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>IdEvent</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Description</th>
            <th>Capacite</th>
          
        </tr>

        <?php
        foreach ($events as $event) {
        ?>

            <tr>
                <td><?= $event['idevent']; ?></td>
                <td><?= $event['nom']; ?></td>
                <td><?= $event['date']; ?></td>
                <td><?= $event['lieu']; ?></td>
                <td><?= $event['description']; ?></td>
                <td><?= $event['capacite']; ?></td>
               
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
