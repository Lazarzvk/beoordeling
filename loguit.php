<?php
// Start sessie
session_start();

// Destroy sessie
session_destroy();

// Stuur gebruker naar index.php
header("Location: index.php");
?>