<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		

		$sql = "UPDATE batch SET batch = '$title' WHERE id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'batch updated successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:batch.php');

?>