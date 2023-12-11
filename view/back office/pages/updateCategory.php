<?php
include '../../../controller/CategoryC.php';
include '../../../model/Category.php';

$error = "";

$category = null;
$categoryC = new CategoryC();

if (isset($_POST["nomC"])) {
    if (!empty($_POST['nomC'])) {
        $category = new Category(null, $_POST['nomC']);
        $categoryC->updateCategory($category, $_POST['idCategorie']);
        header('Location:listCategories.php');
    } else
        $error = "Missing information";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
</head>

<body>
    <button><a href="listCategories.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idCategorie'])) {
        $category = $categoryC->showCategory($_POST['idCategorie']);
    ?>

        <form action="" method="POST">
            <label for="nomC">Name:</label>
            <input type="text" id="nomC" name="nomC" value="<?php echo $category['nomC'] ?>" />
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
            <input type="hidden" value="<?php echo $_POST['idCategorie'] ?>" name="idCategorie">
        </form>
    <?php
    }
    ?>
</body>

</html>
