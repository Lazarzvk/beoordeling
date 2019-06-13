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

?>
<h1>Project toevoegen</h1>
<form method="POST">
    <p>Project:
	    	<?php
	    	$getProjectsQuery = mysqli_query($mysqli, "SELECT * FROM beoordeling_project");

	    	if(mysqli_num_rows($getProjectsQuery) >= 1)
	    	{
	    		echo "<select>";

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
    <p>Start datum: <input type="date"></p>
    <p>Eind datum: <input type="date"></p>
    <p>Begeleider:
		<?php
	    	$getclientQuery = mysqli_query($mysqli, "SELECT * FROM beoordeling_user WHERE level = 1");

	    	if(mysqli_num_rows($getclientQuery) >= 1)
	    	{
	    		echo "<select>";

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
    		if($userRow['activeProject'] > 0)
    		{
    			echo "<p><input type='checkbox' disabled>" . $userRow['username'] . "</p>";
    		}
    		else
    		{
    			echo "<p><input type='checkbox'>" . $userRow['username'] . "</p>";
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