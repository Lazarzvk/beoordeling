<?php

require "session.php";

session_regenerate_id();

$title = "home";

require "header.php";

?>

<h1>Welkom <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></h1>

<?php

require "footer.php";

?>