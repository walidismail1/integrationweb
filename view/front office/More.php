<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "moduleLangue";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM books WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $book = [
            'id' => $row['id'],
            'name' => $row['title'],
            'author' => $row['author'],
            'image' => '/web1/view/back office/pages/' . $row['image_url'],
            'price' => $row['price'],
            'description' => $row['description'],
        ];
    } else {
        $book = null;
    }

    $comments = [];
    $commentsSql = "SELECT * FROM comments WHERE book_id = $product_id";
    $commentsResult = $conn->query($commentsSql);

    if ($commentsResult->num_rows > 0) {
        while ($commentRow = $commentsResult->fetch_assoc()) {
            $comments[] = [
                'id' => $commentRow['id'],
                'text' => $commentRow['comment_text'],
            ];
        }
    }
} else {
    $book = null;
    $comments = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment_text'])) {

        $comment_text = $_POST['comment_text'];

        $insertCommentSql = "INSERT INTO comments (book_id, comment_text) VALUES ('$product_id', '$comment_text')";
        $conn->query($insertCommentSql);


        header("Location: {$_SERVER['REQUEST_URI']}");
        exit;
    } elseif (isset($_POST['edit_comment'])) {

        $comment_id = $_POST['comment_id'];
        $edited_comment_text = $_POST['edited_comment_text'];

        $updateCommentSql = "UPDATE comments SET comment_text = '$edited_comment_text' WHERE id = $comment_id";
        $conn->query($updateCommentSql);
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit;
    } elseif (isset($_POST['delete_comment'])) {

        $comment_id = $_POST['comment_id'];

        $deleteCommentSql = "DELETE FROM comments WHERE id = $comment_id";
        $conn->query($deleteCommentSql);

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
    <title>Book Details</title>
    <link rel="stylesheet" href="css/styleMore.css">
</head>
<body>

    <?php include_once 'header.php'; ?>

    <?php if ($book) : ?>
        <div class="contact-form">
            <h1>Book Details</h1>
            <div class="container">
                <div class="main">
                    <div class="content">
                        <h2><?php echo $book['name']; ?></h2>
                        <p class="author">By <?php echo $book['author']; ?> (Author)</p>
                        <p class="description"><?php echo $book['description']; ?></p>
                        <div class="price">Price: $<?php echo $book['price']; ?></div>
                    </div>
                    <div class="form-img">
                        <img src="<?php echo $book['image']; ?>" alt="">

                        <form method="post" action="">
                            <label for="comment_text">Leave a Comment:</label>
                            <textarea id="comment_text" name="comment_text" rows="4" cols="50"></textarea>
                            <br>
                            <input type="submit" value="Submit Comment">
                        </form>

<div class="comments">
    <?php if (!empty($comments)) : ?>
        <h3>Comments</h3>
        <ul>
            <?php foreach ($comments as $comment) : ?>
                <li>
                    <form class="inline-form" method="post" action="">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                        <input type="text" name="edited_comment_text" value="<?php echo $comment['text']; ?>">
                        <input type="submit" name="edit_comment" value="Edit">
                    </form>
                    <form class="inline-form" method="post" action="">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                        <input type="submit" name="delete_comment" value="Delete">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No comments yet.</p>
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
