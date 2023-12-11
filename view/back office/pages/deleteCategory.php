<?php
include '../../../controller/CategoryC.php';

$categoryC = new CategoryC();
$categoryC->deleteCategory($_GET["id"]);
header('Location:listCategories.php');
?>
