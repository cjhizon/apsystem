<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		

		$sql = "UPDATE position SET description = '$title' WHERE id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Position updated successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:position.php');

?>