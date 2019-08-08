<?php
	//$id=$_SESSION["id"];

	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$employee_id= $_POST['employee_id'];
		//$password= $_POST['password'];
		$campaign= $_POST['campaign'];
		$position= $_POST['position'];
		$batch= $_POST['batch'];
		$schedule = $_POST['schedule'];
		 //$password = md5($password);
		//$password = md5($_POST["password"]);
		$sql = "UPDATE employees SET employee_id = '$employee_id', firstname = '$firstname', lastname = '$lastname', campaign_id ='$campaign', position_id ='$position',batch_id='$batch', schedule_id = '$schedule' WHERE id = '$empid'";
		if($db->query($sql)){
			$_SESSION['success'] = 'Employee updated successfully';
		}
		else{
			$_SESSION['error'] = $db->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: employee.php');
	

?>