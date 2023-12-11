<?php
include '../../../controller/EventC.php';
include '../../../model/Event.php';
$error = "";
$eventC = new EventC();

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["nom"]) &&
            isset($_POST["date"]) &&
            isset($_POST["lieu"]) &&
            isset($_POST["description"]) &&
            isset($_POST["capacite"])
        ) {
            if (
                !empty($_POST['nom']) &&
                !empty($_POST["date"]) &&
                !empty($_POST["lieu"]) &&
                !empty($_POST["description"]) &&
                !empty($_POST["capacite"])
            ) {
                // Convertir la date au format MySQL
                $date = date("Y-m-d", strtotime($_POST["date"]));

                // Convertir la capacité en entier
                $capacite = intval($_POST["capacite"]);

                $event = new Event(
                    null,
                    $_POST['nom'],
                    $date,
                    $_POST['lieu'],
                    $_POST['description'],
                    $capacite
                );

                $eventC->updateEvent($event, $_POST['idevent']);
                header('Location:event.php');
                exit;
            } else {
                $error = "Missing information";
            }
        } elseif (isset($_POST['idevent'])) {
            $event = $eventC->showEvent($_POST['idevent']);
        }
    }
} catch (PDOException $e) {
    $error = "Failed to update event. " . $e->getMessage();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Couleur de fond gris clair */
            color: #343a40; /* Couleur du texte noir */
            margin: 0;
            padding: 0;
            background-image: url('../../uploads/artgallery.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        a {
            color: #dc3545; /* Couleur du lien rouge */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            border-color: #dc3545; /* Couleur de la bordure rouge pour hr */
            margin: 20px 0;
        }

        #error {
            color: #dc3545; /* Couleur du texte d'erreur rouge */
            margin: 10px;
        }

        form {
            background-color: #ffffff; /* Couleur de fond blanc pour le formulaire */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
            background-color: rgba(255, 255, 255, 0.8);
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #dc3545; /* Couleur du texte du label rouge */
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da; /* Bordure grise */
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #dc3545; /* Couleur de fond rouge pour le bouton de soumission */
            color: #ffffff; /* Couleur du texte blanc pour le bouton de soumission */
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c82333; /* Couleur de fond rouge foncé au survol */
        }

        input[type="reset"] {
            background-color: #6c757d; /* Couleur de fond gris pour le bouton de réinitialisation */
            color: #ffffff; /* Couleur du texte blanc pour le bouton de réinitialisation */
            cursor: pointer;
        }

        input[type="reset"]:hover {
            background-color: #5a6268; /* Couleur de fond gris foncé au survol */
        }
    </style>

    <script>
        function validateUpdateForm() {
            var nom = document.getElementById("nom").value;
            var date = document.getElementById("date").value;
            var lieu = document.getElementById("lieu").value;
            var description = document.getElementById("description").value;
            var capacite = document.getElementById("capacite").value;

            // Vérification si les champs obligatoires sont vides
            if (nom === "" || date === "" || lieu === "" || description === "" || capacite === "") {
                alert("Veuillez remplir tous les champs obligatoires.");
                return false;
            }

            // Vérification de la date (supérieure à la date actuelle)
            var currentDate = new Date();
            var selectedDate = new Date(date);

            if (selectedDate <= currentDate) {
                alert("Veuillez sélectionner une date ultérieure à la date actuelle.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
<a href="event.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idevent'])) {
    ?>

        <form action="" method="POST" onsubmit="return validateUpdateForm()">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $event['nom'] ?>" required />
            <span id="erreurNom" style="color: red"></span>

            <label for="date">Date :</label>
            <input type="date" id="date" name="date" value="<?php echo $event['date'] ?>" required />
            <span id="erreurDate" style="color: red"></span>

            <label for="lieu">Lieu :</label>
            <input type="text" id="lieu" name="lieu" value="<?php echo $event['lieu'] ?>" required />
            <span id="erreurLieu" style="color: red"></span>

            <label for="description">Description :</label>
            <input type="text" id="description" name="description" value="<?php echo $event['description'] ?>" required />
            <span id="erreurDescription" style="color: red"></span>

            <label for="capacite">Capacité :</label>
            <input type="number" id="capacite" name="capacite" value="<?php echo $event['capacite'] ?>" required />
            <span id="erreurCapacite" style="color: red"></span>

            <input type="hidden" name="idevent" value="<?php echo $_POST['idevent'] ?>" />

            <input type="submit" value="Save" />
        </form>
    <?php
    }
    ?>
</body>

</html>
