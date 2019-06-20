<!-- 

Beroeps foto upload Database

-->	

<?php
// Database logingegevens
$db_hostname = 'localhost';
$db_username = '81746_DB';
$db_password = 'accD81_9';
$db_database = '81746_DB';

// Maak de database-verbinding
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Als de verbinding niet gemaakt kan worden: geef een melding
if (!$mysqli)
{
	echo "FOUT: geen connectie naar database. <br>";
	echo "ERRNO: " . mysqli_connect_errno() . "<br>";
	echo "ERROR: " . mysqli_connect_error() . "<br>";
}

?>