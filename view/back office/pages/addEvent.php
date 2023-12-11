<?php
include '../../../controller/EventC.php';
include '../../../model/Event.php';

$error = "";
$eventC = new EventC();

$categories = $eventC->listCategories();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $description = $_POST['description'];
    $capacite = $_POST['capacite'];
    $idCategorie = $_POST['idCategorie'] ?? null; 

    if (!is_numeric($capacite) || $capacite <= 0) {
        $error = "La capacité doit être une valeur numérique positive.";
    } else {
        $event = new Event(null, $nom, $date, $lieu, $description, $capacite, $idCategorie);

        $eventC->addEvent($event);

        header('Location: event.php');
        exit; 
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #E12B6B;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color:#E12B6B;
        }

        #error {
            color: red;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #333;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }
        
    </style>

    <script>
        function validateForm() {
            var nom = document.getElementById("nom").value;
            var date = document.getElementById("date").value;
            var lieu = document.getElementById("lieu").value;
            var description = document.getElementById("description").value;
            var capacite = document.getElementById("capacite").value;
            var idCategorie = document.getElementById("idCategorie").value;

            if (nom === "" || date === "" || lieu === "" || description === "" || capacite === "" || idCategorie === "") {
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

            // Vérification de la capacité (positive)
            if (isNaN(capacite) || capacite <= 0) {
                alert("Veuillez entrer une capacité valide (valeur numérique positive).");
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

    <form action="" method="POST" onsubmit="return validateForm()">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required />
        <span id="erreurNom" style="color: red"></span>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required />
        <span id="erreurDate" style="color: red"></span>

        <label for="lieu">Lieu :</label>
        <input type="text" id="lieu" name="lieu" required />
        <span id="erreurLieu" style="color: red"></span>

        <label for="description">Description :</label>
        <input type="text" id="description" name="description" required />
        <span id="erreurDescription" style="color: red"></span>

        <label for="capacite">Capacité :</label>
        <input type="number" id="capacite" name="capacite" required />
        <span id="erreurCapacite" style="color: red"></span>

        <label for="idCategorie">Catégorie :</label>
        <!-- Ajout de la liste déroulante des catégories -->
        <select id="idCategorie" name="idCategorie">
            <?php
            foreach ($categories as $category) {
                echo "<option value='" . $category['idCategorie'] . "'>" . $category['nomC'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Save" />
        <input type="reset" value="Reset" />
    </form>
</body>

</html>
