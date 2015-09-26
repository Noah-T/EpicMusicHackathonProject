<?php

require_once '../dbConn.php';
$db = mysqli_connect ($db_host, $db_user, $db_password, $db_name) OR die ('Could not connect to MySQL: '
 . mysqli_connect_error());

	if (isset($_GET['id'])) {
		$sql = "SELECT * FROM assignments WHERE id = '{$_GET['id']}'";
		$row = mysqli_fetch_assoc(mysqli_query($db, $sql));
		echo "'{$row['songName']}' by '{$row['composer']}'";
	} else {
		$sql = "SELECT * FROM assignments";
		while ($row = mysqli_fetch_assoc(mysqli_query($db, $sql))) {
			echo "'{$row['songName']}' by '{$row['composer']}'";
			echo "</br>";
		}
	}
?>
