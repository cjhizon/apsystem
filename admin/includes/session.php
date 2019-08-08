<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['username']) || trim($_SESSION['username']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM admin WHERE username = '".$_SESSION['username']."'";
	$query = $db->query($sql);
	$user = $query->fetch_assoc();
	
?>