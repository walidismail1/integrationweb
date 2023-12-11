<?php 

session_start();


	include_once '../../controller/userC.php';
    include('C:\xampp\htdocs\web\connection.php');
	require_once 'C:\xampp\htdocs\web1\google.php';

	$loginURL = $gClient->createAuthUrl();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password))
		{

			//read from database
			$query = "SELECT * from register where email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location: site.php");
                        exit;
					}
				}
			}
			
			echo '<script>alert("Wrong email or password!");</script>';		
		}
		else
		{
			echo '<script>alert("Wrong email or password!");</script>';		}
	}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../front office/css/stylelogin.css">
</head>

<body>
  <div class="wrapper">
    <h2>Login</h2>
    <form action="" method="POST">
                    <div class="input-box">
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                <div class="input-box">
                <input type="password" id="password" name="password"placeholder="Create password" required>
                </div>
				<div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                </div>
				
			    	<div class="password-reset-link">
    				<a href="forget_password.php">Forgot Password?</a>
				    </div>
					
					<div class="text">
                <h3>Don't have an account? <a href="signup.php">Sign Up now</a></h3>
                </div>
                <div class="input-box button">
                <input type="submit" value="Register Now">
				</div>
				<div class="input-box button">
				<input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google">
                </div>
                </form>
                </div>
</body>
</html>