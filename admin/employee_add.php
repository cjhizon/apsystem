<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id= $_POST['employee_id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password= $_POST['password'];
		$campaign= $_POST['campaign'];
		$position= $_POST['position'];
		// $password = md5($_POST["password"]);
		$batch= $_POST['batch'];
		
		$schedule = $_POST['schedule'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		/*$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$employee_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);*/
		//

		$sql = "SELECT id FROM employees WHERE employee_id = '$employee_id' LIMIT 1" ;

		$check_query = mysqli_query($db,$sql);
		$count_empnum = mysqli_num_rows($check_query);
		if($count_empnum > 0){
			$message3="Employee number is already available Try Another employee number!";
				echo "
					<script type='text/javascript'>alert('$message3');</script>
				";
			// exit();
		} 
	else {
			$password = md5($password);
		$sql = "INSERT INTO employees (id,employee_id, firstname, lastname, password, campaign_id, position_id, batch_id,  schedule_id, photo, created_on)
		 VALUES (NULL,'$employee_id', '$firstname', '$lastname', '$password', '$campaign','$position', '$batch',  '$schedule', '$filename', NOW())";
		if($db->query($sql)){
			$_SESSION['success'] = 'Employee added successfully';
		}

		else{
			$_SESSION['error'] = $db->error;
		}
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee.php');
?>