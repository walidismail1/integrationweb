<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "description";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sqlDeleteBook = "DELETE FROM artwork WHERE id=$id";
    $conn->query($sqlDeleteBook);
}
header("location: tableau.php");
exit;
?>
