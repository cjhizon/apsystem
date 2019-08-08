<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM schedules WHERE id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Schedule deleted successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: schedule.php');
	
?>