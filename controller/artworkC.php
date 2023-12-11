<?php
include(__DIR__ . '/../configO.php');

class artworkC
{
    private $db;

    public function __construct()
    {
        $this->db = Config::getConnexion();
    }

    public function addartwork($artwork)
    {
        try {
            $query = $this->db->prepare(
                "INSERT INTO artwork (titre, image, price, description)
                VALUES (:titre, :image, :price, :description)"
            );
            $query->execute([
                'titre' => $artwork->gettitre(),
                'image' => $artwork->getimage(),
                'price' => $artwork->getprice(),
                'description' => $artwork->getdescription()
            ]);
        } catch (PDOException $e) {
            // Handle the error (throw exception, log, etc.)
            throw new Exception("Error adding user: " . $e->getMessage());
        }
    }
    public function afficherartwork()
    {
        try {
            $query = $this->db->prepare("SELECT * FROM artwork");
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error fetching users: " . $e->getMessage());
        }
    }
    public function supprimer($id)
    {
        try {
            $sql = "DELETE FROM artwork WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting user: " . $e->getMessage());
        }
    }
    function updateartwork($artwork, $id)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE artwork SET 
                titre = :titre, 
                image = :image, 
                price = :price, 
                description = :description
            WHERE id = :id'
        );

        $result = $query->execute([
            'id' => $id,
            'titre' => $artwork->gettitre(),
            'image' => $artwork->getimage(),
            'price' => $artwork->getprice(),
            'description' => $artwork->getdescription()
        ]);

        if ($result) {
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } else {
            echo "Error updating records";
            print_r($query->errorInfo()); // Display detailed error information
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



}