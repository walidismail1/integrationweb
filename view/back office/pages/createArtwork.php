<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "description";

$conn = new mysqli($servername, $username, $password, $dbname);

$title = "";
$price = "";
$description = "";
$imageFileName = "";
$imageTempName = "";

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageFileName = $_FILES['imageUpload']['name'];
    $imageTempName = $_FILES['imageUpload']['tmp_name'];

    // Validate inputs
    if (empty($title) || empty($description) || empty($imageFileName) || empty($imageTempName)) {
        $errorMessage = "All the fields are required";
    } elseif (!is_numeric($price) || $price <= 0 || !preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
        $errorMessage = "Price should be a valid positive number, with up to two decimal places";
    } else {
        // File upload and path setup
        $targetDirectory = "back office/uploads/";
        $imagePath = $targetDirectory . $imageFileName;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errorMessage = "Invalid file format. Please upload a valid image.";
        } else {
            // Move uploaded file to destination
            move_uploaded_file($imageTempName, $imagePath);

            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO artwork (title, price, description, image_url) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sdss", $title, $price, $description, $imagePath);


            // Execute the statement
            $result = $stmt->execute();

            if (!$result) {
                $errorMessage = "Invalid query: " . $conn->error;
            } else {
                // Reset form fields after successful insertion
                $title = "";
                $price = "";
                $description = "";
                $imageFileName = "";
                $imageTempName = "";

                $successMessage = "Artwork added successfully";

                // Redirect to index.php
                header("location: tableau.php");
                exit;
            }

            // Close the statement
            $stmt->close();
        }
    }
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
            <h2>Add a New Artwork</h2>

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
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label custom-label">Title</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label custom-label">Price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label custom-label">Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label custom-label">Image</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="imageUpload">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="tableau.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>

    </html>
