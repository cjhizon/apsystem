<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, late.late_id AS lateid FROM late LEFT JOIN employees on employees.id=late.emp_id  LEFT JOIN batch ON batch.id=employees.batch_id WHERE late.late_id='$id'";

		$query = $db->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>