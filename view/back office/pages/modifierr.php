<?php
ob_start();

include '../../../controller/userC.php';
include '../../../model/user.php';  
$_POST["id"]=$_GET["id"];
$userC = new userC();
$user = null;

$errors = [];
if(isset($_POST["submit"]))
if (isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["telephone"]) &&
    isset($_POST["email"]) &&
    isset($_POST['password'])
) {
    if (!empty($_POST['first_name']) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["telephone"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST['password'])
    ) {
        $hashedPassword = $_POST['password'];

        $user = new user(
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['telephone'],
            $_POST['email'],
            $hashedPassword
        );

        $userC->updateUser($user, $_POST['id']);

        header('Location: tables.php');
        exit;
    } else {
        $errors[] = "Missing information";
    }
}

// Retrieve user information if editing an existing user
if (isset($_POST['id'])) {
    $user = $userC->afficherUser($_POST['id']);
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
    <button><a href="tables.php">Back to list</a></button>
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
                <td><label for="first_name">First Name :</label></td>
                <td>
                    <input type="text" id="first_name" name="first_name" value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="last_name">Last Name :</label></td>
                <td>
                    <input type="text" id="last_name" name="last_name" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="telephone">Telephone :</label></td>
                <td>
                    <input type="text" id="telephone" name="telephone" value="<?php echo isset($user['telephone']) ? $user['telephone'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>
                    <input type="text" id="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td><label for="password">Password :</label></td>
                <td>
                    <input type="password" id="password" name="password" value="<?php echo isset($user['password']) ? $user['password'] : ''; ?>" />
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