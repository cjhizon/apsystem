<?php
error_reporting(0);
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "apsystem";
		//$port = "3306"

		$db = new mysqli($host, $user, $pass, $db);

		if($db->errno) {
			die ($db->error);

		}

?>