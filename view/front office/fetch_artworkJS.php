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

$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = [
        'id' => $row['id'],
        'name' => $row['title'],
        'description' => $row['description'], 
        'image' => '/web1/view/back office/pages/' . $row['image_url'],
        'price' => $row['price'],
    ];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($books);
?>
