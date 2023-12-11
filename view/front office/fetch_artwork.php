<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "description";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}      

$sql = "SELECT * FROM artwork";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

$bookCount = 0;

while ($row = $result->fetch_assoc()) {
    $imagePath = 'C:\xampp\htdocs\web1\view\back office\pages\back office\uploads' . $row["image_url"];
    echo "
        <div class='book'>
            <img src='" . $imagePath . "' alt='Book Image'>
            <h3>" . $row["title"] . "</h3>
            <p>" . $row["price"] . "</p>   
        </div>
    ";

    $bookCount++;
    if ($bookCount == 3) {
        break;
    }
}

$conn->close();
?>
