<?php

require 'C:\xampp\htdocs\web1\view\front office\vendor\autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\web1\view\front office\tcpdf\tcpdf.php';
include 'C:\xampp\htdocs\web1\controller\EventC.php';

function generateQRCode($data) {
    $qrCode = new QrCode($data);
    $qrCode->setSize(100); // Adjust the size as needed
    $qrCode->setForegroundColor(new Color(0, 0, 0));
    $qrCode->setBackgroundColor(new Color(255, 255, 255));

    // Use PngWriter to get the QR code image as a string
    $writer = new PngWriter();
    return $writer->write($qrCode)->getString();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserve'])) {
    $event_id = $_POST['event_id'];

    $eventC = new EventC();
    $event = $eventC->getEventById($event_id);

    if ($event && $event['capacite'] > 0) {
        $user_name = 'Nom de l\'utilisateur';
        $user_email = 'Email de l\'utilisateur';

        $eventC->updateEventCapacity($event_id, $event['capacite'] - 1);

        // Génération du fichier PDF avec TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();

     /// Add the logo to the PDF - Stretch the image to cover the entire page with reduced opacity
$imagePath = 'uploads/ipad0.png';
$pdf->Image($imagePath, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 50, 'C', false, false, 1, false, false, false);





        $pdf->SetFont('times', 'B', 16);
        $pdf->SetTextColor(21, 50, 148); // Bleu foncé
        $pdf->SetFont('times', 'I', 14);
        $pdf->SetTextColor(0, 0, 0); // Noir
        $pdf->Cell(0, 10, 'Confirmez votre réservation', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, "Cher $user_name,", 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->MultiCell(0, 10, "Merci d'avoir réservé pour notre événement. Nous sommes ravis de vous accueillir. Voici les détails de l'événement :", 0, 'L');
        $pdf->Ln(10);

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, 'Nom de l\'événement :', 0, 1, 'L');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $event['nom'], 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, 'Date :', 0, 1, 'L');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $event['date'], 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, 'Lieu :', 0, 1, 'L');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $event['lieu'], 0, 1, 'L');
        $pdf->Ln(10);

        // Générer le code QR et l'ajouter au PDF
        $qrCodeData = "User: $user_name\nEvent: {$event['nom']}\nDate: {$event['date']}\nLieu: {$event['lieu']}";
        $qrCodeImage = generateQRCode($qrCodeData);
        $pdf->Image('@' . $qrCodeImage, $pdf->GetX(), $pdf->GetY(), 30, 30); // Adjust size and position as needed

        $pdfPath = 'C:\xampp\htdocs\continue\phpCRUD\views' . 'confirmation_reservation_' . $event_id . '.pdf';
        $pdf->Output($pdfPath, 'F');

        // Envoi de l'e-mail avec PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chams2002bejaoui@gmail.com';
            $mail->Password = 'cjgt qlnb cmtk vjyh';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('chams2002bejaoui@gmail.com', 'CluturArtMundo');
            $mail->addAddress('mohamedchamseddine.bejaoui@esprit.tn', 'chams');

            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de réservation';
            $mail->Body = "Cher $user_name,<br><br>Merci d'avoir réservé pour notre événement. Nous sommes ravis de vous accueillir. Voici les détails de l'événement :<br><br><strong>Nom de l'événement :</strong> {$event['nom']}<br><strong>Date :</strong> {$event['date']}<br><strong>Lieu :</strong> {$event['lieu']}";

            // Attach the PDF to the email
            $mail->addAttachment($pdfPath, 'confirmation_reservation.pdf', 'base64', 'application/pdf');

            $mail->send();

            echo '<script>alert("E-mail de confirmation envoyé avec succès!");</script>';
        } catch (Exception $e) {
            echo '<script>alert("Erreur lors de l\'envoi de l\'e-mail de confirmation: ' . $mail->ErrorInfo . '");</script>';
        }

        unlink($pdfPath);

        echo '<script>window.location.href = "listEventsByCategory.php";</script>';
        exit;
    } else {
        echo '<script>alert("La capacité est épuisée!");</script>';
    }
}
?>
