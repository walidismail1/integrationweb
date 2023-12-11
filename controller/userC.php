<?php
include(__DIR__ . '/../config.php');


class UserC
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Config::getConnexion();
    }

    public function addUser($user)
    {
        try {
            $query = $this->pdo->prepare(
                "INSERT INTO register (first_name, last_name, telephone, email, password)
                VALUES (:first_name, :last_name, :telephone, :email, :password)"
            );
            $query->execute([
                'first_name' => $user->getfirst_name(),
                'last_name' => $user->getlast_name(),
                'telephone' => $user->gettelephone(),
                'email' => $user->getemail(),
                'password' => $user->getpassword()
            ]);
        } catch (PDOException $e) {
            // Handle the error (throw exception, log, etc.)
            throw new Exception("Error adding user: " . $e->getMessage());
        }
    }

    public function afficherUser()
    {
        try {
            $query = $this->pdo->prepare("SELECT * FROM register");
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
            $sql = "DELETE FROM register WHERE id = :id";
            $query = $this->pdo->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting user: " . $e->getMessage());
        }
    }
    public function getUserByEmailOrUsername($email, $username)
    {
        $query = "SELECT * FROM register WHERE email = :email ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }


    function updateUser($user, $id)
{
    try {
        $pdo = config::getConnexion();
        $query = $pdo->prepare(
            'UPDATE register SET 
                first_name = :first_name, 
                last_name = :last_name, 
                telephone = :telephone, 
                email = :email,
                password = :password
            WHERE id = :id'
        );

        $result = $query->execute([
            'id' => $id,
            'first_name' => $user->getfirst_name(),
            'last_name' => $user->getlast_name(),
            'telephone' => $user->gettelephone(),
            'email' => $user->getemail(),
            'password' => $user->getpassword()
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
    public function recupererUser($id){
        $sql="SELECT * from register where id=$id";
        $pdo = config::getConnexion();
        try{
        $query=$pdo->prepare($sql);
        $query->execute();
        $liste=$query->fetch();
        return $liste;
        }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
    }
    function check_login($con)
{

	if(isset($_SESSION['id']))
	{

		
		$query = "SELECT * from register where id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location:registre.php");
	die;

}
    
    }
?>
