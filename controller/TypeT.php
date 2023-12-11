<?php
include 'C:\xampp\htdocs\web1\configS.php';
include 'C:\xampp\htdocs\web1\model\Type.php';

class TypeT
{
    /* function listType()
    {
        $sql = "SELECT * FROM type";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }*/
    function listType() {
        $db = config::getConnexion();
        try {
            $sql = "SELECT formation.*, type.* 
                    FROM type
                    LEFT JOIN formation ON type.idFormation = formation.idFormation";
    
            $query = $db->prepare($sql);
            $query->execute();
    
            $result = $query->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return []; 
        }
    }
    
    
    

    function deletetype($id)
    {
        $sql = "DELETE FROM type WHERE idType = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addType($type)
{
    $sql = "INSERT INTO type (name, descriptions, outilspossibles)  
            VALUES (:name, :descriptions, :outilspossibles)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'name' => $type->getname(),
            'descriptions' => $type->getdescriptions(),
            'outilspossibles' => $type->getoutilspossibles()
        ]);
    } catch (Exception $e) {
        // Log the error for debugging
        error_log('Error adding type: ' . $e->getMessage());
    }
}


     /*public function updateType($idType,$name,$descriptions,$outilspossibles)
    {
       $pdo=config::getConnexion();
       try 
       { 
        //$query() prépare et exécute une requête SQL en un seul appel de fonction
        $query = $pdo->prepare("UPDATE type SET name=:name ,descriptions=:descriptions,outilspossibles=:outilspossibles WHERE idType=:idType");
         $query->execute
         ([
           'idType' =>$idType,
           'name' =>$name,
           'descriptions' =>$descriptions,
           'outilspossibles' =>$outilspossibles
          
      
       ]);  
       }
       catch(PDOException $e)
       { die('erreur:' . $e->getMessage());}      
    }*/
    function updateType(Type $type) {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare("UPDATE type SET name=:name, descriptions=:descriptions, outilspossibles=:outilspossibles WHERE idType=:idType");
            $query->execute([
                'idType' => $type->getIdType(),
                'name' => $type->getName(),
                'descriptions' => $type->getDescriptions(),
                'outilspossibles' => $type->getOutilsPossibles()
            ]);

            // Ajoutez une vérification pour voir s'il y a une erreur SQL
            if ($query->rowCount() > 0) {
                echo 'Modification réussie.';
            } else {
                echo 'Aucune modification effectuée.';
            }
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    

    function showType($id)
    {
        $sql = "SELECT * from type where idType = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $type = $query->fetch();
            return $type;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}




