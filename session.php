<?php
require "config.inc.php";

session_start();

// Controleer of er een username en id is opgeslagen
if(!isset($_SESSION['username']) || strlen($_SESSION['username']) && !isset($_SESSION['user_id']) || strlen($_SESSION['user_id']) == 0)
{
	header("location:index.php");
	die();
}

// Als langer dan 5 (300 seconde) minuten inactief
if((time() - 999999) > $_SESSION['timestamp'])
{
	session_destroy();
	header("location:index.php");
}
// OK, update timestamp
else
{
	$_SESSION['timestamp'] = time();
}

?>