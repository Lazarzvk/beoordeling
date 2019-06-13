<?php
// Start de sessie
session_start();

require "config.inc.php";

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

if(isset($_POST['submit']) && isset($username) && isset($password))
{
	if(!empty($username) && !empty($password))
	{
		$password = sha1($password);
		
		$query = mysqli_query($mysqli, "SELECT * FROM beoordeling_user WHERE username = '$username' AND password = '$password'");

		if(mysqli_num_rows($query) == 1)
		{
			$user = mysqli_fetch_array($query);

			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['firstName'] = $user['firstName'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['level'] = $user['level'];
			$_SESSION['timestamp'] = time();

			// Stuur naar de homepage
			header("Location: home.php");
		}
		else
		{
			echo "Incorrecte inlog";
		}
	}
	else
	{
		echo "<p>Vul alle velden in!</p>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<figure>
		<img src="images/background.jpeg" alt="background">
	</figure>
	<section>
		<form method="POST">
			<label>Gebruikersnaam:</label>
			<input type="text" name="username">
			<label>Wachtwoord:</label>
			<input type="password" name="password">
			<input type="submit" name="submit">
		</form>
	</section>
</body>
</html>