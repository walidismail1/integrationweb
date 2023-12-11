<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "premier";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT f.*, fav.favori_num FROM formation f
        JOIN favori fav ON f.id = fav.formation_id
        WHERE fav.favori_num = 1";

$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = [
        'id' => $row['id'],
        'name' => $row['nom'],
        'description' => $row['description'], 
        'image' => '/web1/view/back office/pages/' . $row['image_url'],
        'price' => $row['price'],
    ];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($books);
?>
