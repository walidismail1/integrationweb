<?php
session_start();
include_once '../../controller/userC.php';
include_once '../../model/user.php';
include_once 'C:\xampp\htdocs\web1\connection.php';

$userC = new userC();
$s = 0;

if (
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['telephone']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {
    $user = new user(
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['password']
    );
    $s = 1;
    header("Location: registre.php");
}

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing Up</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../front office/css/stylelogin.css">
    <script>
        function validateForm() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            var telephone = document.getElementById('telephone').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var checkbox = document.getElementById('terms_checkbox');

            if (firstName === '' || lastName === '' || telephone === '' || email === '' || password === '') {
                alert('Veuillez remplir tous les champs obligatoires.');
                return false;
            }

            var nameRegex = /^[A-Za-z]+$/;
            if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
                alert('Les champs first name et last name doivent contenir uniquement des lettres.');
                return false;
            }

            var phoneRegex = /^[0-9]+$/;
            if (!phoneRegex.test(telephone)) {
                alert('Le champ téléphone doit contenir uniquement des chiffres.');
                return false;
            }


            var emailRegex = /^[^\s@]+@(gmail\.com|esprit\.tn)$/;
            if (!emailRegex.test(email)) {
                alert('Veuillez entrer une adresse e-mail valide se terminant par @gmail.com ou @esprit.tn.');
                return false;
            }

            var passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]*$/;
            if (!passwordRegex.test(password)) {
                alert('Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre, et ne doit pas contenir de points, de virgules ou de caractères spéciaux.');
                return false;
            }

            if (!checkbox.checked) {
                alert('Veuillez accepter les termes et conditions.');
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
  <div class="wrapper">
    <h2>Sign Up</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" onsubmit="return validateForm()">
        <div class="input-box">
        <input type="text" id="first_name" name="first_name" placeholder="Enter your First Name" required>
        </div>
            <div class="input-box">
            <input type="text" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
            </div>
                <div class="input-box">
                <input type="text" id="telephone" name="telephone" placeholder="Enter your Phone Number" required>
                </div>
                    <div class="input-box">
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                <div class="input-box">
                <input type="password" id="password" name="password"placeholder="Create password" required>
                </div>
                <div class="form-check form-check-info text-start ps-0">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                    </div>
                <div class="input-box button">
                <input type="Submit" value="Register Now">
                </div>
                <div class="text">
                <h3>Already have an account? <a href="registre.php">Login now</a></h3>
                </div>
                </form>
                </div>
                <?php if ($s == 1)
        //variable pour verifier si le formulaire est rempli
        {
        $userC->addUser($user);
    }

    ?>
</body>
</html>