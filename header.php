<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href="home.php">Beoordelingssysteem</a></li>

            <?php
            
            if($_SESSION['level'] == 1)
            {

            ?>
			<li><a href="addProject.php">Aanmaken</a></li>
            <li><a href="addUser.php">Voeg user toe</a></li>

            <?php

            }
            ?>
            
			<li><input type="text" name="text"></li>
			<li><a href="loguit.php">Uitloggen</a></li>
		</ul>
	</nav>