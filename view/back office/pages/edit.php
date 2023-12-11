<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleLangue";

$conn = new mysqli($servername, $username, $password, $dbname);

$title = "";
$author = "";
$price = "";
$description = "";
$imageFileName = "";
$imageTempName = "";
$id = "";

$successMessage = "";
$errorMessage = "";
function getBookComments($conn, $bookId)
{
    $comments = [];
    $sql = "SELECT * FROM comments WHERE book_id = $bookId";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row['comment_text'];
        }
    }

    return $comments;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: shop.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: shop.php");
        exit;
    }

    $title = $row['title'];
    $author = $row['author'];
    $price = $row['price'];
    $description = $row['description'];
    $comments = getBookComments($conn, $id);
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['imageUpload'])) {
        $imageFileName = $_FILES['imageUpload']['name'];
        $imageTempName = $_FILES['imageUpload']['tmp_name'];

        $targetDirectory = '';
        $imagePath = $targetDirectory . basename($imageFileName);

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        if (move_uploaded_file($imageTempName, $imagePath)) {
        } else {
            $errorMessage = "Error uploading the file.";
        }
    }
    
    do  {
        if (empty($title) || empty($author) || empty($price) || empty($description)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $stmt = $conn->prepare("UPDATE books SET title=?, author=?, price=?, description=?, image_url=? WHERE id = ?");
        $stmt->bind_param("sssssi", $title, $author, $price, $description, $imagePath, $id);
        $stmt->execute();
        $stmt->close();

        $newComments = $_POST['comments'];
        $conn->query("DELETE FROM comments WHERE book_id = $id");
        foreach ($newComments as $comment) {
            $comment = $conn->real_escape_string($comment);
            $conn->query("INSERT INTO comments (book_id, comment_text) VALUES ($id, '$comment')");
        }

        $successMessage = "Book and comments updated successfully";

        header("location: shop.php");
        exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit Book</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="imageUpload">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Comments</label>
                <div class="col-sm-6">
                    <?php
                    foreach ($comments as $index => $comment) {
                        echo "
                        <div class='mb-2'>
                            <input type='text' class='form-control' name='comments[$index]' value='$comment'>
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="shop.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
