<?php
require 'C:\xampp\htdocs\web1\configC.php';

class EventC
{
    public function listEvents()
    {
        $sql = "SELECT * FROM eevents";
        $db = config::getConnexion();

        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function listCategories()
{
    $sql = "SELECT * FROM categorie";
    $db = config::getConnexion();

    try {
        $categories = $db->query($sql);
       
       return $categories->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


public function listEventsByCategory($idCategorie)
{
    $sql = "SELECT e.idevent, e.nom, e.date, e.lieu, e.description, e.capacite, c.nomC
            FROM eevents e
            JOIN categorie c ON e.idCategorie = c.idCategorie
            WHERE e.idCategorie = $idCategorie";

    $db = config::getConnexion();

    try {
        $events = $db->query($sql);
        return $events;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}



    public function deleteEvent($ide)
    {
        $sql = "DELETE FROM eevents WHERE idevent = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addEvent($event)
    {
        $sql = "INSERT INTO eevents VALUES (NULL, :nom, :date, :lieu, :description, :capacite, :idCategorie)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $event->getNom(),
                'date' => $event->getDate(),
                'lieu' => $event->getLieu(),
                'description' => $event->getDescription(),
                'capacite' => $event->getCapacite(),
                'idCategorie' => $event->getIdCategorie(), // Utilisation de l'id de la catégorie
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showEvent($id)
    {
        $sql = "SELECT * FROM eevents WHERE idevent = $id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateEvent($event, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE eevents SET 
                    nom = :nom, 
                    date = :date, 
                    lieu = :lieu, 
                    description = :description, 
                    capacite = :capacite,
                    idCategorie = :idCategorie
                WHERE idevent = :id'
            );
            
            $query->execute([
                'id' => $id,
                'nom' => $event->getNom(),
                'date' => $event->getDate(),
                'lieu' => $event->getLieu(),
                'description' => $event->getDescription(),
                'capacite' => $event->getCapacite(),
                'idCategorie' => $event->getIdCategorie(), // Utilisation de l'id de la catégorie
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function getEventById($id)
    {
        $sql = "SELECT * FROM eevents WHERE idevent = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function updateEventCapacity($event_id, $new_capacity)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE eevents SET capacite = :new_capacity WHERE idevent = :event_id');
        
        $query->execute([
            'new_capacity' => $new_capacity,
            'event_id' => $event_id,
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        $e->getMessage();
    }
}


    
}
?>
