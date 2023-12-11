<?php
include(__DIR__ . '/../configO.php');
//include ('C:\xampp\htdocs\web1\model\artwork.php');

class commandeC
{
    private $db;

    public function __construct()
    {
      

        $this->db = Config::getConnexion();

    }

    public function addArticleCommande($commande, $artworkw)
    { 
      
        try {
            $this->db->beginTransaction();

            // Insert into artwork table using the foreign key
            $artworkQuery = $this->db->prepare(
                "INSERT INTO artwork ( title, price, description)
                VALUES ( :title, :price, :description)"
            );

            $artworkQuery->execute([
                // Assuming you have a method to get artwork ID
                'title' => $artworkw->gettitre(), // Assuming you have a method to get artwork title
                'price' => $artworkw->getprice(), // Assuming you have a method to get artwork price
                'description' => $artworkw->getdescription(), // Assuming you have a method to get artwork description
            ]);
            $last_id = $this->db->lastInsertId();
            echo "New record created successfully. Last inserted ID is: " . $last_id;
         
            // Insert into commande table
            $commandeQuery = $this->db->prepare(
                "INSERT INTO commande (email, nom, prenom, artwork)
                VALUES (:email, :nom, :prenom, :artwork)"
            );
    
            $commandeQuery->execute([
                ':email' => $commande->getemail(),
                ':nom' => $commande->getnom(),
                ':prenom' => $commande->getprenom(),
                ':artwork' => $last_id, // Assuming you have a method to get artwork ID
            ]);
    
           
    
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            // Handle the error (throw exception, log, etc.)
            throw new Exception("Error adding user: " . $e->getMessage());
        }
    }
    
    public function afficherartwork()
    {
        try {
            $query = $this->db->prepare("SELECT * FROM commande JOIN artwork WHERE commande.artwork = artwork.id AND status <> 'accepter' AND status <> 'refuser'");
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error fetching users: " . $e->getMessage());
        }
    }
    
    public function modifier_status_artwork_commande($id_commande,$artwork_status, $to_email)
    {
        //$db = config::getConnexion();
        
        
        try {

            $query =  $this->db->prepare('UPDATE commande SET 
             status =:status WHERE id_commande = :id_commande');
            $result = $query->execute([
                ':status' => $artwork_status,
                ':id_commande' => $id_commande
            ]);
            
            if ($result) {
                echo $query->rowCount() . " records UPDATED successfully <br>";
                if($artwork_status = 'accepter')
            {
                //$to_email = $_POST['email'] ;
                $subject = "Simple Email Testing via PHP";
                $body = "Hello,nn It is a testing email sent by PHP Script";
                $headers = "From: chams2002bejaoui@gmail.com";
               
                if (mail($to_email, $subject, $body, $headers))  {
                    echo "Email successfully sent to $to_email...";
                } else {
                  echo "Email sending failed...";
                } 
                              
            }
            } else {
                echo "Error updating records";
                print_r($query->errorInfo()); // Display detailed error information
            }
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new Exception("Error fetching users: " . $e->getMessage());
        }
    }
    
}
    ?>
