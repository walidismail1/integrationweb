<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "premier";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sqlDeleteComments = "DELETE FROM favori WHERE formation_id=$id";
    $conn->query($sqlDeleteComments);

    $sqlDeleteBook = "DELETE FROM formation WHERE id=$id";
    $conn->query($sqlDeleteBook);
}
header("location: workshop.php");
exit;
?>
