<?php

echo 'hi';

include(../dbConn.php);

$db = mysqli_connect ($db_host, $db_user, $db_password, $db_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());


if (isset($_POST['submit'])) {
	/* Create String for error collection */
	$error = '';

	/* Check for empty vars */
	if (empty($_POST['songName'])) {
		$error = $error . ' Err: songName is a required field';
	}

	if (empty($_POST['description'])) {
		$error = $error . ' Err: description is a required field';
	}

	if (empty($_POST['composer'])) {
		$error = $error . ' Err: composer is a required field';
	}
}

?>