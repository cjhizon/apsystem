<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, undertime.ut_id AS utid FROM undertime LEFT JOIN employees on employees.id=undertime.emp_id WHERE undertime.ut_id='$id'";
		$query = $db->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>