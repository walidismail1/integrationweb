<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "premier";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM formation WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $book = [
            'id' => $row['id'],
            'name' => $row['nom'],
            'durée' => $row['durée'],
            'image' => '/web1/view/back office/pages/' . $row['image_url'],
            'price' => $row['price'],
            'description' => $row['description'],
        ];
    } else {
        $book = null;
    }

    // Check if there is already a favorite for this product
    $favoriSql = "SELECT * FROM favori WHERE formation_id = $product_id";
    $favoriResult = $conn->query($favoriSql);
    $hasFavorite = $favoriResult->num_rows > 0;

} else {
    $book = null;
    $hasFavorite = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_favorites']) && !$hasFavorite) {
        // Add favorite only if there is no existing favorite
        $insertFavoriSql = "INSERT INTO favori (formation_id, favori_num) VALUES ('$product_id', 1)";
        $conn->query($insertFavoriSql);
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit;
    } elseif (isset($_POST['delete_favori'])) {
        $favori_id = $_POST['favori_id'];
        $deleteFavoriSql = "DELETE FROM favori WHERE id = $favori_id";
        $conn->query($deleteFavoriSql);
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation Details</title>
    <link rel="stylesheet" href="css/styleMoreformation.css">
</head>
<body>

    <?php include_once 'headerf.php'; ?>

    <?php if ($book) : ?>
        <div class="contact-form">
            <h1>Formation Details</h1>
            <div class="container">
                <div class="main">
                    <div class="content">
                        <h2><?php echo $book['name']; ?></h2>
                        <p class="description"><?php echo $book['description']; ?></p>
                        <div class="price">Price: $<?php echo $book['price']; ?></div>
                        <div class="duration">Duration: <?php echo $book['durée']; ?></div>
                    </div>
                    <div class="form-img">
                        <img src="<?php echo $book['image']; ?>" alt="">
                        <form method="post" action="">
                            <?php if (!$hasFavorite) : ?>
                                <input type="submit" name="add_to_favorites" value="Add to Favorites">
                            <?php endif; ?>
                        </form>

                        <div class="favoris">
                            <?php if ($hasFavorite) : ?>
                                <h3>Added to Favorites</h3>
                                <ul>
                                    <?php
                                    // Display the favorite, if it exists
                                    $favoriRow = $favoriResult->fetch_assoc();
                                    ?>
                                    <li>
                                        <form class="inline-form" method="post" action="">
                                            <input type="hidden" name="favori_id" value="<?php echo $favoriRow['id']; ?>">
                                            <input type="submit" name="delete_favori" value="Delete">
                                        </form>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>No book found.</p>
    <?php endif; ?>

    <?php include_once 'footer.php'; ?>

</body>
</html>
