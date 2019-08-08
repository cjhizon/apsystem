<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		$hours = $_POST['hours'] + ($_POST['mins']/60);
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $db->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO undertime (emp_id, date_ut, mins_ut) VALUES ('$employee_id', '$date', '$hours')";
			if($db->query($sql)){
				$_SESSION['success'] = 'Undertime added successfully';
			}
			else{
				$_SESSION['error'] = $db->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: undertime.php');

?>