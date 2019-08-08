<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		

		$sql = "INSERT INTO batch (batch) VALUES ('$title')";
		if($db->query($sql)){
			$_SESSION['success'] = 'Batch name added successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: batch.php');

?>