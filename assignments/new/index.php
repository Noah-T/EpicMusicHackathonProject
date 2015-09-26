<?php

require_once '../../dbConn.php';
$db = mysqli_connect ($db_host, $db_user, $db_password, $db_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

/* On press of submit */
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

	$sha = sha1($_POST['songName']);

	date_default_timezone_set('America/New_York');

	$date = date('m/d/Y h:i:s a', time());

	$filePath = 'tmp';

	if (empty($error)) {
		/* If no errors, add to the db */
		$sql = "INSERT INTO assignments (id, songName, filePath, description, composer, date) VALUES ('$sha', '{$_POST['songName']}', '$filePath', '{$_POST['description']}', '{$_POST['composer']}', '$date')";
		$result = mysqli_query($db, $sql);
	}

	/* Redirect user to index.php */
	header("Location: http://45.55.240.148/assignments");
	exit();
	}

?>

<!DOCTYPE html>
<html lang ="en">
	<head>
	<title>LOL HACKATHON</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
	<article class="container">
	<h1>New Assignment</h1>
	<form action="newAssignment.php" method="post">
		<input type="text" name="songName" value="Song Name">
		<input type="text" name="description" value="Description">
		<input type="text" name="composer" value="Composer">
		<input type="submit" name="submit" value="Create Assignment!" />
	</form>
	</article>
	</body>
</html>
