<?php

require "session.php";

session_regenerate_id();

$title = "voeg project toe";

require "header.php";

if($_SESSION['level'] == 0)
{
    header("Location: home.php");
}
else
{

$selectedProject = strip_tags($mysqli, $_POST['selectedProject']);
$start_time = strip_tags($mysqli, $_POST['start_time']);
$end_time = strip_tags($mysqli, $_POST['end_time']);
$selectedTeacher = strip_tags($mysqli, $_POST['selectedTeacher']);

$selectedProject = mysqli_real_escape_string($mysqli, $_POST['selectedProject']);	
$start_time = mysqli_real_escape_string($mysqli, $_POST['start_time']);	
$end_time = mysqli_real_escape_string($mysqli, $_POST['end_time']);	
$selectedTeacher = mysqli_real_escape_string($mysqli, $_POST['selectedTeacher']);	

// Verwerking van het project toevoegen
if(isset($_POST['submit']) && isset($_POST['selectedProject']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['selectedTeacher']))
{
	if(!empty($_POST['selectedProject']) && !empty($_POST['start_time']) && !empty($_POST['end_time']) && !empty($_POST['selectedTeacher']) && !empty($_POST['student']))
	{
		// Converteer de start datum
		$startTime = new DateTime($start_time);
		$startTime = date_format($startTime, "Y-m-d");

		// Converteer de eind datum
		$endTime = new DateTime($end_time);
		$endTime = date_format($endTime, "Y-m-d");

		echo $startTime . "<br>" . $endTime . "<br>";

		if(count($_POST['student']) > 1)
		{
			foreach($_POST['student'] as $s)
			{
				echo $s . "<br>";
			}
		}
		else
		{
			echo "<p>U heeft " . count($_POST['student']) . " leerling toegevoegd aan het project " . $_POST['selectedProject'];
		}
	}
	else
	{
		echo "<p>Vul alle velden in en kies tenminste 1 leerling!</p>";
	}
}

// Einde van het project toevoegen

?>       
<h1>Project toevoegen</h1>
<form method="POST">
    <p>Project:
	    	<?php
	    	$getProjectsQuery = mysqli_query($mysqli, "SELECT * FROM beoordeling_project");

	    	if(mysqli_num_rows($getProjectsQuery) >= 1)
	    	{
	    		echo "<select name='selectedProject'>";

	    		while($projectRow = mysqli_fetch_array($getProjectsQuery))
	    		{
	    			echo "<option value='" . $projectRow['project_id'] . "'>" . $projectRow['name'] . "(" . $projectRow['type'] . ") </option>";
	    		}

	    		echo "</select>";
	    	}
	    	else
	    	{
	    		echo "Er ging iets fout, probeer het opnieuw";
	    	}

	    	?>
	</p>
    <p>Start datum: <input type="date" name="start_time"></p>
    <p>Eind datum: <input type="date" name="end_time"></p>
    <p>Begeleider:
		<?php
	    	$getclientQuery = mysqli_query($mysqli, "SELECT * FROM beoordeling_user WHERE level = 1");

	    	if(mysqli_num_rows($getclientQuery) >= 1)
	    	{
	    		echo "<select name='selectedTeacher'>";

	    		while($clientRow = mysqli_fetch_array($getclientQuery))
	    		{
	    			echo "<option value='" . $clientRow['user_id'] . "'>" . $clientRow['lastName'] . "</option>";
	    		}

	    		echo "</select>";
	    	}
	    	else
	    	{
	    		echo "Er ging iets fout, probeer het opnieuw";
	    	}

	    	?>
    </p>
    <p>Studenten:</p>
    <?php
    $getUserQuery = mysqli_query($mysqli, "SELECT * FROM beoordeling_user WHERE level = 0");

    if(mysqli_num_rows($getUserQuery) >= 1)
    {
    	while($userRow = mysqli_fetch_array($getUserQuery))
    	{
    		if($userRow['activeProject'] >= 1)
    		{
    			echo "<p><input type='checkbox' disabled>" . $userRow['username'] . "</p>";
    		}
    		else
    		{
    			echo "<label><input type='checkbox' name='student[]' value='" . $userRow['user_id'] . "'>" . $userRow['username'] . "</label><br>";
    		}
    	}
    }

    ?>
    <input type="submit" name="submit">
</form>
<h2></h2>
<?php

require "footer.php";
}
?>