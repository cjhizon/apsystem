<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM undertime WHERE ut_id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Undertime deleted successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: undertime.php');
	
?>