<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "functions.php";

if (isset($_POST['email'])) {
  $conn = new mysqli('localhost', 'root', '', 'login');

  $email = $conn->real_escape_string($_POST['email']);

  $sql = $conn->query("SELECT id FROM register WHERE email='$email'");
  if ($sql->num_rows > 0) {

      $token = generateNewString();

    $conn->query("UPDATE register SET token='$token', 
                tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                WHERE email='$email'
      ");

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();
    $mail->addAddress($email);
    $mail->setFrom("hmida.nadhem@esprit.tn", "CulturArt Moundo");
    $mail->Subject = "Reset Password";
    $mail->isHTML(true);
    $mail->Body = "
        Hi,<br><br>
        
        In order to reset your password, please click on the link below:<br>
        <a href='
        http://domain.com/resetPassword.php?email=$email&token=$token
        '>http://domain.com/resetPassword.php?email=$email&token=$token</a><br><br>
        
        Kind Regards,<br>
        CulturArt Moundo
    ";

    if ($mail->send())
        exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
    else
        exit(json_encode(array("status" => 0, "msg" => 'Something Wrong Just Happened! Please try again!')));
  } else
      exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Inputs!')));
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../front office/css/stylelogin.css">-->
</head>

<body>
  <div class="wrapper">
    <h2>RESET PASSWORD</h2>
    <form method="POST" action="" >
                    <div class="input-box">
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                <div class="input-box button">
                <input type="submit" name="reset" value="Send Now">
                </div>
                </form>
                </div>
    <script type="text/javascript">
        var email = $("#email");

        $(document).ready(function () {
            $('.btn-primary').on('click', function () {
                if (email.val() != "") {
                    email.css('border', '1px solid green');

                    $.ajax({
                       url: 'forgotPassword.php',
                       method: 'POST',
                       dataType: 'json',
                       data: {
                           email: email.val()
                       }, success: function (response) {
                            if (!response.success)
                                $("#response").html(response.msg).css('color', "red");
                            else
                                $("#response").html(response.msg).css('color', "green");
                        }
                    });
                } else
                    email.css('border', '1px solid red');
            });
        });
    </script>
</body>
</html>



