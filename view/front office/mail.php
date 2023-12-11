<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendConfirmation'])) {
    $smtpHost = 'smtp.gmail.com';
    $smtpUsername = 'chams2002bejaoui@gmail.com';
    $smtpPassword = 'cjgt qlnb cmtk vjyh'; // Utilisez le mot de passe de votre compte Gmail
    $smtpPort = 587;
    $smtpSecurity = 'tls';

    $senderEmail = 'chams2002bejaoui@gmail.com';
    $senderName = 'CluturArtMundo';

    $recipientEmail = 'mohamedchamseddine.bejaoui@esprit.tn';
    $recipientName = 'chams';

    $subject = 'confirmation';
    $body = 'je suis participants ';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecurity;
        $mail->Port = $smtpPort;

        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress($recipientEmail, $recipientName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        echo 'E-mail envoyé avec succès!';
    } catch (Exception $e) {
        echo 'Erreur lors de l\'envoi de l\'e-mail: ', $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Email</title>

    <!-- Ajoutez ici le lien vers le fichier CSS si nécessaire -->
</head>

<body>
    <h2>Confirmation Email</h2>

    <form method="post">
        <input type="submit" name="sendConfirmation" value="Envoyer Confirmation">
    </form>

    <!-- Vous pouvez également ajouter ici une section pour afficher le résultat de l'envoi de l'e-mail -->

</body>

</html>
