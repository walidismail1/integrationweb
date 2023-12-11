<?php
ob_start();


include ('C:\xampp\htdocs\web1\controller\artworkC.php');
include ('C:\xampp\htdocs\web1\model\artwork.php');  
$_POST["id"]=$_GET["id"];
$artworkC = new artworkC();
$artwork = null;

$errors = [];
if(isset($_POST["submit"]))
if (isset($_POST["titre"]) &&
    isset($_POST["image"]) &&
    isset($_POST["price"]) &&
    isset($_POST["description"]) 
) {
    if (!empty($_POST['titre']) &&
        !empty($_POST["image"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["description"])
    ) {
        $artwork = new artwork(
            $_POST['titre'],
            $_POST['image'],
            $_POST['price'],
            $_POST['description']
        );

        $artworkC->updateartwork($artwork, $_POST['id']);

        header('Location: tableau.php');
        exit;
    } else {
        $errors[] = "Missing information";
    }
}

// Retrieve user information if editing an existing user
if (isset($_POST['id'])) {
    $artwork = $artworkC->afficherartwork($_POST['id']);
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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #E12C6C;
            color: #fff;
            cursor: pointer;
        }

        input[type="reset"] {
            background-color: #f44336;
            color: #fff;
            cursor: pointer;
        }

        #error {
            margin-bottom: 16px;
        }

        #error p {
            color: red;
            margin: 0;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        hr {
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <button><a href="tableau.php">Back to artwork</a></button>
    <hr>

    <div id="error">
        <?php
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
    </div>

    <form action="" method="POST">

        <table>
            <tr>
                <td><label for="titre">titre :</label></td>
                <td>
                    <input type="text" id="titre" name="titre" value="<?php echo isset($artwork['titre']) ? $artwork['titre'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="image">image :</label></td>
                <td>
                    <input type="file" id="image" name="image" value="<?php echo isset($artwork['image']) ?$artwork['image'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="price">price :</label></td>
                <td>
                    <input type="text" id="price" name="price" value="<?php echo isset($artwork['price']) ? $artwork['price'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="description">description :</label></td>
                <td>
                    <input type="text" id="description" name="description" value="<?php echo isset($artwork['description']) ? $artwork['description'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>