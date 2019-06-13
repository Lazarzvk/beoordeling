<?php

require "session.php";

session_regenerate_id();

// Onderstaande is nodig voor het maken van de PDF files
require('fpdf181/fpdf.php');

$title = "Gebruiker toevoegen";

require "header.php";

if($_SESSION['level'] == 0)
{
    header("Location: home.php");
}
else
{
/*
* Voeg user toe
*/

// Functie voor het random maken van een wachtwoord
function randomPassword()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Loop tot er 20 karakters zijn
    for($i = 0; $i < 20; $i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

$username = strip_tags($mysqi, $_POST['username']);
$firstName = strip_tags($mysqi, $_POST['firstName']);
$lastName = strip_tags($mysqi, $_POST['lastName']);

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
$lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);

if(isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['lastName']))
{
    if(!empty($_POST['username']) && !empty($_POST['firstName']) && !empty($_POST['lastName']))
    {
        if(ctype_alpha($_POST['firstName']) && ctype_alpha($_POST['lastName']))
        {
            $password = randomPassword();

            /*
            * Maak pdf
            */
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(0,10,"Username: " . $_POST['username'] . "");
            $pdf->ln(10);
            $pdf->Cell(0,10,"Password: $password");
            $content = $pdf->Output('userInfo.pdf', 'F');

            $password = sha1($password);

            $query = mysqli_query($mysqli, "INSERT INTO `beoordeling_user` (`user_id`, `username`, `password`, `firstName`, `lastName`, `activeProject`, `level`) VALUES (NULL, '$username', '" . $password . "', '$firstName', '$lastName', 'nee', '0');");

            if($query == 1)
            {

                header("Location: addUser.php");

                file_put_contents($pdf->Output('userInfo.pdf'), $content); 
            }
            else
            {
                echo "Er ging iets fout, probeer het opnieuw";
            }
        }
        else
        {
            echo "De voornaam en achternaam mogen alleen uit letters bestaan!";
        }
    }
    else
    {
        echo "Vul alle velden in!";
    }
}

?>
<h1>Voeg hier een leerling toe!</h1>
<form method="POST">
    <label>gebruikersnaam: <input type="text" name="username"></label>
    <label>Voornaam: <input type="text" name="firstName"></label>
    <label>Achternaam: <input type="text" name="lastName"></label>
    <input type="submit" name="submit">
</form>

<?php

if(file_exists("userInfo.pdf"))
{
    ?>
    <button type="button"><a href="download.php" class="download">Download hier het bestand</a></button>
<?php
}

}