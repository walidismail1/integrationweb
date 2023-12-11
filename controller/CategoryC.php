<?php

require 'C:\xampp\htdocs\web1\configC.php';

class CategoryC
{
    public function listCategories()
    {
        $sql = "SELECT * FROM categorie";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCategory($id)
    {
        $sql = "DELETE FROM categorie WHERE idCategorie = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addCategory($category)
    {
        $sql = "INSERT INTO categorie VALUES (NULL, :nomC)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['nomC' => $category->getNomC()]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showCategory($id)
    {
        $sql = "SELECT * FROM categorie WHERE idCategorie = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateCategory($category, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE categorie SET nomC = :nomC WHERE idCategorie = :id');
            $query->execute(['id' => $id, 'nomC' => $category->getNomC()]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
