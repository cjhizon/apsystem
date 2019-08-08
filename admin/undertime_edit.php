<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$mins = ($_POST['hours']*60) + $_POST['mins'] ;
		

		$sql = "UPDATE undertime SET mins_ut = '$mins', date_ut = '$date' WHERE ut_id = '$id'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Undertime updated successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:undertime.php');

?>