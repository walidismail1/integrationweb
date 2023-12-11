<?php
include "../../../controller/EventC.php";

// Création d'une instance du contrôleur des événements
$eventC = new EventC();

// Récupération de la liste des événements
$events = $eventC->listEvents();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Events</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <center>
        <h1>List of Events</h1>
        <h2>
            <a href="addEvent.php">Add Event</a>
        </h2>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id Event</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Description</th>
            <th>Capacité</th>
            <th>Update</th>
            <th>Delete</th>
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
                <td align="center">
                    <form method="POST" action="updateEvent.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $event['idevent']; ?> name="idevent">
                    </form>
                </td>
                <td>
                    <a href="deleteEvent.php?id=<?php echo $event['idevent']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
