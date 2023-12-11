<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "moduleLangue";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sqlDeleteComments = "DELETE FROM comments WHERE book_id=$id";
    $conn->query($sqlDeleteComments);

    $sqlDeleteBook = "DELETE FROM books WHERE id=$id";
    $conn->query($sqlDeleteBook);
}
header("location: shop.php");
exit;
?>
