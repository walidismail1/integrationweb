<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "premier";

$conn = new mysqli($servername, $username, $password, $dbname);

$nom = "";
$durée = "";
$price = "";
$description = "";
$imageFileName = "";
$imageTempName = "";
$id = "";

$successMessage = "";
$errorMessage = "";
function getBookComments($conn, $formationId)
{
    $favori = [];
    $sql = "SELECT * FROM favori WHERE formation_id = $formationId";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $favori[] = $row['favori_num'];
        }
    }

    return $favori;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: workshop.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM formation WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: workshop.php");
        exit;
    }

    $nom = $row['nom'];
    $durée = $row['durée'];
    $price = $row['price'];
    $description = $row['description'];
    $favori = getBookComments($conn, $id);
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $durée = $_POST['durée'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['imageUpload'])) {
        $imageFileName = $_FILES['imageUpload']['name'];
        $imageTempName = $_FILES['imageUpload']['tmp_name'];

        $targetDirectory = "back office/uploads/";
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
        if (empty($nom) || empty($durée) || empty($price) || empty($description)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $stmt = $conn->prepare("UPDATE formation SET nom=?, durée=?, price=?, description=?, image_url=? WHERE id = ?");
        $stmt->bind_param("sssssi", $nom, $durée, $price, $description, $imagePath, $id);
        $stmt->execute();
        $stmt->close();

        $newfavori = $_POST['favori'];
        $conn->query("DELETE FROM favori WHERE formation_id = $id");
        foreach ($newfavori as $favori) {
            $favori = $conn->real_escape_string($favori);
            $conn->query("INSERT INTO favori (formation_id, favori_num) VALUES ($id, '$favori')");
        }

        $successMessage = "Book and comments updated successfully";

        header("location: workshop.php");
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
        <h2>Edit Formation</h2>

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
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Durée</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="durée" value="<?php echo $durée; ?>">
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
                <label class="col-sm-3 col-form-label">Favori</label>
                <div class="col-sm-6">
                <div class="row mb-3">
        <?php
        foreach ($favori as $index => $favoriValue) {
            echo "
            <div class='mb-2'>
                <input class='form-control' name='favori[$index]' value='$favoriValue' readonly>
            </div>
            ";
        }
        ?>
    </div>
</div>

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
                    <a class="btn btn-outline-primary" href="/projetweb2/back office/indexformation.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
