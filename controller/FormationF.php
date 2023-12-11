<?php
include 'C:\xampp\htdocs\web1\configS.php';
include 'C:\xampp\htdocs\web1\model\Formation.php';

class FormationF
{
    public function listFormation()
    {
        $sql = "SELECT * FROM formation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteFormation($id)
    {
        $sql = "DELETE FROM formation WHERE idFormation = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function addFormation($formation) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare(
                'INSERT INTO formation (nom, description, durée, prix)  
                VALUES (:nom, :description, :durée, :prix)'
            );
            $query->execute([
                'nom' => $formation->getNom(),
                'description' => $formation->getDescription(),
                'durée' => $formation->getDuree(),
                'prix' => $formation->getPrix()
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    /*function addFormation( Formation $formation)
    {
        $sql = "INSERT INTO formation (nom, description, duree, prix)  
                VALUES (:nom, :description, :duree, :prix)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $formation->getNom(),
                'description' => $formation->getDescription(),
                'duree' => $formation->getDurée(),
                'prix' => $formation->getPrix()
            ]);
        } catch (Exception $e) {
            error_log('Error adding formation: ' . $e->getMessage());
        }
    }*/

      /*function updateFormation($idFormation,$nom,$description,$durée,$prix)
    {
       $pdo=config::getConnexion();
       try 
       { 
        //$query() prépare et exécute une requête SQL en un seul appel de fonction
        $query = $pdo->prepare("UPDATE formation SET nom=:nom ,description=:description ,durée=:durée,prix=:prix WHERE idFormation=:idFormation");
         $query->execute
         ([
           'idFormation' =>$idFormation,
           'nom' =>$nom,
           'description' =>$description,
           'durée' =>$durée,
           'prix' =>$prix
      
       ]);  
       }
       catch(PDOException $e)
       { die('erreur:' . $e->getMessage());}      
    }*/
    function updateFormation($idFormation, $nom, $description, $durée, $prix)
    {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("UPDATE formation SET nom=:nom, description=:description, `durée`=:durée, prix=:prix WHERE idFormation=:idFormation");
            $query->execute([
                'idFormation' => $idFormation,
                'nom' => $nom,
                'description' => $description,
                'durée' => $durée,  // Assurez-vous que la clé est correcte
                'prix' => $prix
            ]);
    
            // ... (restez inchangé)
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    

    function showFormationt($id)
    {
        $sql = "SELECT * from formation where idFormation = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $formation = $query->fetch();
            return $formation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }

    
    }
    function getBestFormationsByPrice($limit = 5)
    {
    $pdo = config::getConnexion();
    try {
        $query = $pdo->prepare("SELECT * FROM formation ORDER BY prix DESC LIMIT :limit");
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
    }

    function updateFavori($idFormation)
	{
    $pdo = config::getConnexion();

    try {
        $query = $pdo->prepare("UPDATE formation SET favori = 1 WHERE idFormation = :idFormation");
        $query->bindParam(':idFormation', $idFormation, PDO::PARAM_INT);
        $query->execute();

        return true;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


}




