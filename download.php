<?php

if(file_exists("userInfo.pdf"))
{
	header("Content-disposition: attachment; filename=userInfo.pdf");
	header('Content-type: application/pdf');
	readfile("userInfo.pdf");

	unlink("userInfo.pdf");
}
else
{
	header("Location: addUser.php");
}

?>